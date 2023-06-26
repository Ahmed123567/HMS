import os
import math
import numpy as np
import tensorflow as tf
import math
from keras.preprocessing.image import ImageDataGenerator


def ai(dir):
    def generate_data(DIR):
        datagen = ImageDataGenerator(rescale=1./255.)
        
        generator = datagen.flow_from_directory(
            DIR,
            batch_size=64,
            shuffle=True,
            seed=42,
            class_mode='binary',
            target_size=(224, 224),
            classes={'Samples': 0}
        )
        return generator
    
    input_shape = (224, 224, 3)
    base_model = tf.keras.applications.vgg16.VGG16(
        weights='imagenet', 
        include_top=False,
        input_shape=input_shape
    )
    
    base_model.trainable = False
    model_vgg16 = tf.keras.Sequential()
    model_vgg16.add(base_model)
    model_vgg16.add(tf.keras.layers.GlobalAveragePooling2D())

    model_vgg16.add(tf.keras.layers.Flatten())
    model_vgg16.add(tf.keras.layers.Dense(256, activation='relu'))
    model_vgg16.add(tf.keras.layers.Dropout(0.5))
    model_vgg16.add(tf.keras.layers.Dense(256, activation='relu'))
    model_vgg16.add(tf.keras.layers.Dropout(0.5))

    model_vgg16.add(tf.keras.layers.Dense(3, activation='softmax'))

    model_vgg16.compile(loss='SparseCategoricalCrossentropy', 
                optimizer=tf.keras.optimizers.Adam(0.001),
                metrics=['acc'])

    model_vgg16.load_weights('./vgg16_best.h5')
    test_generator = generate_data(dir)
    
    xtest = []
    xtest.append(test_generator[0][0])
        
    ypred_prob =model_vgg16.predict(xtest)
    ypred = np.argmax(ypred_prob,axis=1)
    diag={0:'Normal',1:'Viral Pneumonia', 2:'Covid'} 
    return(diag[ypred[0]])

