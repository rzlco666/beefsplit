import sys
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import joblib
import time
import datetime
import warnings
warnings.filterwarnings('ignore')
from sklearn.preprocessing import MinMaxScaler
from sklearn.metrics import r2_score
from math import sqrt
from sklearn.metrics import mean_squared_error
from sklearn.metrics import confusion_matrix
from sklearn.metrics import classification_report
from tabulate import tabulate

start = time.time()

def main():
        load_dataset()
        normalisasi_data()
        load_model()
        prediksi_usia()
        cetak_hasil()

def load_dataset():
        file2 = sys.argv[1]
        direktori2 = "D:\\laragon\\www\\beefsplit\\frontend\\web\\datasetfile\\"
        tampung = direktori2 + file2

        dte = pd.read_excel(tampung)
        #dte = pd.read_excel("D:\\python\\api\\dataset\\BeefPork_Test.xlsx")
        raw_X = dte.iloc[:, 0:10].values #dataset
        return raw_X

def normalisasi_data():
        #bersihin null
        raw_X = load_dataset()
        
        clean_X = np.nan_to_num(raw_X)
        
        sc = MinMaxScaler(feature_range=(0,10))
        sc.fit(raw_X)
        X = np.array(sc.transform(clean_X))
        X_test = []
        X_test.extend(X)
        return X_test

def load_model():
        klasifier = joblib.load('D:\\laragon\\www\\beefsplit\\frontend\\web\\engine\\model\\classifier_knn_model.pkl')
        return klasifier

def prediksi_usia():
        raw_X = load_dataset()
        X_test = normalisasi_data()
        klasifier = load_model()
        
        y_pred = klasifier.predict(X_test)
        return y_pred

def cetak_hasil():
        raw_X = load_dataset()
        y_pred = prediksi_usia()
        
        pd.set_option('display.max_columns', None)
        pd.set_option('display.max_rows', None)

        tabel = pd.DataFrame(raw_X)
        tabel.columns = ['MQ2','MQ4','MQ6','MQ9','MQ135','MQ136','MQ137','MQ138','Temperature','Humidity']


        tabel2 = pd.DataFrame(y_pred)
        tabel2.columns = ['Prediksi Kelas']

        frames = [tabel, tabel2]

        tabelfix = pd.concat(frames, axis=1)
        tabelfix.index += 1

        tabu = tabulate(tabelfix, headers = 'keys', tablefmt = 'html')
        tabu2 = tabu.replace('<table>', '<table class="table table-centered mb-0">')
        tabu3 = tabu2.replace('<thead>', '<thead class="table-dark">')

        print(tabu3)

main()

stop = time.time()
waktu = (stop-start)
cetak = (time.strftime('%M:%S', time.gmtime(waktu)))
print("</div><div class='row mt-2'><div class='col-lg-12'><div class='alert alert-primary' role='alert'><span class='alert-icon'><i class='ni ni-watch-time'></i></span><span class='alert-text'>Total prediction time :<strong>", cetak, "</strong></span></div></div>")
