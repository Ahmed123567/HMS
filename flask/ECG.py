import pandas as pd
import numpy as np
import torch 
import torch.nn as nn
import torch.optim as optim
from torch.utils.data import TensorDataset, DataLoader
import matplotlib.pyplot as plt

class_names = {0: 'Normal', 1: 'SVT', 2: 'VPC', 3: 'STEMI', 4: 'Sinus pause'}


def ecg(dir):
        #load csv files to pandas dataframe
    train_df = pd.read_csv(dir, header=None)
    X_df = train_df.iloc[:, :-1]
    X_df = X_df.astype('float')
    plt.plot(X_df.iloc[0,:186]); plt.savefig('x.png')
    return
    #the input dims are 187 and the output dims are 5
    X_np = X_df.to_numpy()
    X_np = X_np.reshape(-1, 1, 187)

    # Data normalization
    X_mean = X_np.mean()
    X_std = X_np.std()
    X_max = X_np.max()
    X_min = X_np.min()
    X_norm = X_np - X_mean
    X_norm *= 1/X_std

    #saving the normalized data to a csv file
    #np.savetxt('X_norm.csv', X_norm.squeeze(), delimiter=',')

    # Loading the normalized variables from disk
    #X_norm = np.loadtxt('X_norm.csv', delimiter=',').reshape(-1, 1, 187)

    X_val=X_norm

    hyper_params = {'bs': 1024,
                                    'lr': 1e-3,
                                    'lr_decay': 0.3,
                                    'epochs':50,
                                    }
    val_ds = torch.utils.data.TensorDataset(torch.from_numpy(X_val).float(), torch.from_numpy(np.array([0])).long())
    val_dl = DataLoader(val_ds, batch_size=hyper_params['bs'])

    def nin_block(in_channels, out_channels, kernel_size, padding, strides):
        return nn.Sequential(
            nn.Conv1d(in_channels, out_channels, kernel_size, strides, padding),
            nn.BatchNorm1d(out_channels),
            nn.GELU(),
            nn.Conv1d(out_channels, out_channels, kernel_size=1), nn.GELU(),
            nn.Conv1d(out_channels, out_channels, kernel_size=1), nn.GELU()
        )

    def get_model():
        return nn.Sequential( #input shape: (batch_size, 1, 187)
            nin_block(1, 48, kernel_size=11, strides=4, padding=0), #output shape: (batch_size, 48, 44)
            nn.MaxPool1d(3, stride=2), #output shape: (batch_size, 48, 21)
            nin_block(48, 128, kernel_size=5, strides=1, padding=2), #output shape: (batch_size, 128, 21)
            nn.MaxPool1d(3, stride=2), #output shape: (batch_size, 128, 10)
            nin_block(128, 256, kernel_size=3, strides=1, padding=1), #output shape: (batch_size, 256, 10)
            nn.MaxPool1d(3, stride=2), #output shape: (batch_size, 256, 4)
            nn.Dropout(0.4), 
            #last layers for classification of 5 classes
            nin_block(256, 5, kernel_size=3, strides=1, padding=1), #output shape: (batch_size, 5, 4)
            nn.AdaptiveAvgPool1d(1), #output shape: (batch_size, 5, 1)
            nn.Flatten() #output shape: (batch_size, 5)
        )

    model = get_model()

    model.load_state_dict(torch.load('best_model0.99.pt'))

    device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
    model = model.to(device)
    model.eval()
    y_pred = []
    for x, y in val_dl:
        x = x.to(device)
        y = y.to(device)
        output = model(x) #out shape: (batch_size, 5)
        y_pred.extend(torch.argmax(output, dim=1).cpu().numpy())
        return(class_names[y_pred[0]])
ai('H.csv')