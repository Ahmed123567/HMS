import os
from flask import Flask, request
from flask_restful import Api, Resource
from werkzeug.utils import secure_filename
import pathlib
import shutil
from covid import ai
from helper import cleanFolder
from BrainTumor import checkHasBrainTumor
# from ECG import ecg
app = Flask(__name__)

api = Api(app)

APP_ROOT = os.path.dirname(os.path.abspath(__file__))
UPLOAD_FOLD = APP_ROOT  + '\pic\Samples'
UPLOAD_FOLDER = os.path.join(APP_ROOT, UPLOAD_FOLD)

app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER



class Covid(Resource):
    
    def post(self): 
        cleanFolder(UPLOAD_FOLD)
        request.files["file"].save(os.path.join(app.config['UPLOAD_FOLDER'], secure_filename(request.files["file"].filename)))
        return {"result" : ai(
            "./pic"
        )} 


class BrainTumer(Resource):
    
    def post(self): 
        cleanFolder(UPLOAD_FOLD)
        request.files["file"].save(os.path.join(app.config['UPLOAD_FOLDER'], secure_filename(request.files["file"].filename)))
        return {"result" : checkHasBrainTumor(
            "./pic"
        )} 


# class Ecg(Resource):
    
#     def post(self): 
#         cleanFolder(UPLOAD_FOLD)
#         request.files["file"].save(os.path.join(app.config['UPLOAD_FOLDER'], secure_filename(request.files["file"].filename)))
#         return {"result" : checkHasBrainTumor(
#             "./pic"
#         )} 


api.add_resource(Covid, "/covid")
api.add_resource(BrainTumer, "/brainTumor")
# api.add_resource(BrainTumer, "/ecg")

app.run(debug = True);



