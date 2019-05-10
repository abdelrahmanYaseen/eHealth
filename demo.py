import pandas as pd
import numpy as np
import os
ORIGIN_PATH = os.getcwd()

def getSubjectNum(fileName) :
        import re
        n = re.findall(r'\d+', fileName)
        return int(n[0])


class acceleration_chest_X :
     id =0
     name = 'acceleration_chest_X'

class acceleration_chest_Y :
     id =1
     name = 'acceleration_chest_Y'

class acceleration_chest_Z :
     id =2
     name = 'acceleration_chest_Z'

class ECG_lead_1 :
     id=3
     name = 'ECG_lead_1'

class ECG_lead_2 :
     id=4
     name = 'ECG_lead_2'

class acceleration_left_ankle_X :
     id =5
     name = 'acceleration_left_ankle_X'

class acceleration_left_ankle_Y :
     id =6
     name = 'acceleration_left_ankle_Y'

class acceleration_left_ankle_Z :
     id =7
     name = 'acceleration_left_ankle_Z'

class gyro_left_ankle_X :
     id =8
     name = 'gyro_left_ankle_X'

class gyro_left_ankle_Y :
     id =9
     name = 'gyro_left_ankle_Y'

class gyro_left_ankle_Z :
     id =10
     name = 'gyro_left_ankle_Z'

class magnetometer_left_ankle_X :
     id =11
     name = 'magnetometer_left_ankle_X'

class magnetometer_left_ankle_Y :
     id =12
     name = 'magnetometer_left_ankle_Y'

class magnetometer_left_ankle_Z :
     id =13
     name = 'magnetometer_left_ankle_Z'

class acceleration_right_lower_arm_X :
     id =14
     name = 'acceleration_right_lower_arm_X'

class acceleration_right_lower_arm_Y :
     id =15
     name = 'acceleration_right_lower_arm_Y'

class acceleration_right_lower_arm_Z :
     id =16
     name = 'acceleration_right_lower_arm_Z'

class gyro_right_lower_arm_X :
     id =17
     name = 'gyro_right_lower_arm_X'

class gyro_right_lower_arm_Y :
     id =18
     name = 'gyro_right_lower_arm_Y'

class gyro_right_lower_arm_Z :
     id =19
     name = 'gyro_right_lower_arm_Z'

class magnetometer_right_lower_arm_X :
     id =20
     name = 'magnetometer_right_lower_arm_X'

class magnetometer_right_lower_arm_Y :
     id =21
     name = 'magnetometer_right_lower_arm_Y'


class magnetometer_right_lower_arm_Z :
     id =22
     name = 'magnetometer_right_lower_arm_Z'

print("classes defined")
class mHealthSensor:
    def __init__(self,TYPE,freq=50,sourceData="mHealth_subject3.log",realisitc=False):
        self.frequency=freq
        self.sourceData=sourceData
        self.column=TYPE.id
        self.name=TYPE.name
        self.realisitc=realisitc
        self.subjectNum=getSubjectNum(self.sourceData)
        self.generateInputFile()
        self.datapool=pd.DataFrame(np.array([]))



    def generateInputFile(self):
        X =  np.array([])
        Y =  np.array([])
        df = pd.read_csv(self.sourceData, header=None, delim_whitespace=True)
        df = df[df[23]!=0] #drop 0 labeled features
        readings_df = pd.DataFrame(df[self.column].copy())
        targets_df = pd.DataFrame(df[23].copy())
        reading_np = readings_df.values

        rps=self.frequency
        activities=range(0,13)

        # #         segmentation
        for i in range(int(readings_df.shape[0]/rps)):
            if  float(targets_df[i*rps:i*rps+rps].mean()) in activities:
                Y=np.append(Y,targets_df[i*rps:i*rps+rps].mean()) #new
                X=np.append(X,readings_df[i*rps:i*rps+rps].values)

        X=X.reshape(-1,rps)
        OutDF = pd.DataFrame(X)
        OutDF['labels']=Y
        OutDF.reset_index
        OutDF.to_csv(self.name+"_subject"+str(self.subjectNum), sep='\t',index=False)

    #returns value , target
    def getReading(self,activity=1):
        if self.realisitc:
            import time
            time.sleep(1)
        if self.datapool.empty == True:
            self.datapool= pd.read_csv(self.name+"_subject"+str(self.subjectNum), sep='\t',index_col=False)
        readings = self.datapool.loc[self.datapool.labels==activity,]
        randIndex = np.random.randint(0,len(readings))
        return np.array(readings.iloc[randIndex,range(0,self.frequency)]), readings.iloc[randIndex,self.frequency]


# os.chdir(ORIGIN_PATH)
# source = os.path.join(ORIGIN_PATH,"MHEALTHDATASET","mHealth_subject3.log")
# gyro = mHealthSensor(TYPE=gyro_left_ankle_Z,freq=10,sourceData=source,realisitc=True)
# ECG  =mHealthSensor(TYPE=ECG_lead_1,freq=50,sourceData=source,realisitc=True)
#


from google_drive_downloader import GoogleDriveDownloader as gdd
if not os.path.isfile(os.path.join("MODELS","ecg.sav")):
    gdd.download_file_from_google_drive(file_id='1ZKUsE9l-iHZ7_z7OKUpcG6BbiJhKsdy0',
                                    dest_path=os.path.join("MODELS","ecg.sav"))
if not os.path.isfile(os.path.join("MODELS","knn.sav")):
    gdd.download_file_from_google_drive(file_id='1WpZuJLhcMaI40DWGVPeJyijSWSsWngze',
                                    dest_path=os.path.join("MODELS","knn.sav"))

from sklearn.externals import joblib
ActuatorsPredictor = joblib.load(os.path.join("MODELS","knn.sav"))
ECGPredictor = joblib.load(os.path.join("MODELS","ecg.sav"))

print("Models loaded")


#THREADING

import threading
import time
import os
import random
import keyboard
from sklearn.externals import joblib
from IPython.display import clear_output, display
ACTUATOR_BUFFER=[]
ECG_BUFFER=[]
os.chdir(ORIGIN_PATH)
source = os.path.join(ORIGIN_PATH,"MHEALTHDATASET","mHealth_subject3.log")
gyroSensor = mHealthSensor(TYPE=gyro_left_ankle_Z,freq=50,sourceData=source,realisitc=True)
ECGSensor  = mHealthSensor(TYPE=ECG_lead_1,freq=50,sourceData=source,realisitc=True)
ActuatorsPredictor=joblib.load(os.path.join("MODELS","knn.sav"))
ECGPredictor=joblib.load(os.path.join("MODELS","ecg.sav"))


def actuatorsThread(ACTUATOR_WRAPPER):
    # while True:
    #     time.sleep(0.5)
    #     clear_output(wait=True)
    #     if keyboard.is_pressed('a'):
    ACTUATOR_WRAPPER[0],_=gyroSensor.getReading(activity=ACTUATOR_WRAPPER[1])
    print("new Actuator data generated ", '-','true label:',_)
        # else:
        #     print("Actuator sensor NOT DETECTED")
        # time.sleep(0.5)
        # if keyboard.is_pressed('t'):
        #     return


def ECGThread(ECG_WRAPPER):
    # while True:
        # time.sleep(0.5)
        # clear_output(wait=True)
        # if keyboard.is_pressed('e'):
    ECG_WRAPPER[0],_=ECGSensor.getReading(activity=ECG_WRAPPER[1])
    print("new ECG data generated :", '-','true label:',_)
        # else:
        #     print("ECG sensor NOT DETECTED")
        # time.sleep(0.5)
        # if keyboard.is_pressed('t'):
        #     return

def chA(x,ACTUATOR_WRAPPER):
    ACTUATOR_WRAPPER[1]=x
    print("The subject is doing activity number ",x)
def chE(x,ACTUATOR_WRAPPER):
    ECG_WRAPPER[1] = x
    print("The heart rate of the subject is that of activity number ",x)
def chBoth(x,ACTUATOR_WRAPPER,ECG_WRAPPER):
    print("The subject is doing activity number ",x)
    print("The heart rate of the subject is that of activity number ",x)
    ACTUATOR_WRAPPER[1]=x
    ECG_WRAPPER[1] = x
    print("b",x)

target=1
ACTUATOR_BUFFER=[]
ECG_BUFFER=[]
ACTUATOR_WRAPPER=[ACTUATOR_BUFFER,target]
ECG_WRAPPER=[ECG_BUFFER,target]







# import threading
# t1 = threading.Thread(target=actuatorsThread,args=(ACTUATOR_WRAPPER,))
# t2 = threading.Thread(target=ECGThread,args=(ECG_WRAPPER,))
# def startThreads(t1,t2):
#     # starting thread 1
#     t1.start()
#     # starting thread 2
#     t2.start()
# startThreads(t1,t2)
# # # wait until thread 1 is completely executed
# # t1.join()
# # # wait until thread 2 is completely executed
# # t2.join()
# print("Threads invoked")
# t=0




keyboard.add_hotkey("1",chBoth,args=(1,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("2",chBoth,args=(2,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("3",chBoth,args=(3,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("4",chBoth,args=(4,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("5",chBoth,args=(5,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("6",chBoth,args=(6,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("7",chBoth,args=(7,ACTUATOR_WRAPPER,ECG_WRAPPER))
keyboard.add_hotkey("8",chBoth,args=(8,ACTUATOR_WRAPPER,ECG_WRAPPER))

keyboard.add_hotkey("ctrl+1",chA,args=(1,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+1",chE,args=(1,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+2",chA,args=(2,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+2",chE,args=(2,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+3",chA,args=(3,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+3",chE,args=(3,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+4",chA,args=(4,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+4",chE,args=(4,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+5",chA,args=(5,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+5",chE,args=(5,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+6",chA,args=(6,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+6",chE,args=(6,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+7",chA,args=(7,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+7",chE,args=(7,ECG_WRAPPER))
keyboard.add_hotkey("ctrl+8",chA,args=(8,ACTUATOR_WRAPPER))
keyboard.add_hotkey("shift+8",chE,args=(8,ECG_WRAPPER))
# keyboard.add_hotkey("r",startThreads,args=(t1,t2))
keyboard.add_hotkey("e",ECGThread,args=(ECG_WRAPPER,))
keyboard.add_hotkey("a",actuatorsThread,args=(ACTUATOR_WRAPPER,))

print("hotkeys binded")
t=0
while(True):
    # activity=np.random.randint(1,13)
    time.sleep(1)
    if (len(ECG_WRAPPER[0])>0) and (len(ACTUATOR_WRAPPER[0])>0):
        Activity_predited_ECG = ECGPredictor.predict(np.array(ECG_WRAPPER[0]).reshape(1, -1))
        Activity_predited_GYR = ActuatorsPredictor.predict(np.array(ACTUATOR_WRAPPER[0]).reshape(1, -1))
        # print(Activity_predited_ECG,'<-E-|',ECG_WRAPPER[1],':',ACTUATOR_WRAPPER[1],'|-A->',Activity_predited_GYR)
        print("Activity Predicted (via GYR): ",Activity_predited_GYR)
        print("Activity Predicted (via ECG): ",Activity_predited_ECG)
        if Activity_predited_ECG == Activity_predited_GYR:
            print(">> ", t)
            t+=1
        ECG_WRAPPER[0]=[]
        ACTUATOR_WRAPPER[0]=[]
    else:
        print("No readings :",len(ECG_WRAPPER[0]),", ",len(ACTUATOR_WRAPPER[0]))
