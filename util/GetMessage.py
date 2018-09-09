#coding=utf-8
import os
from mutagen.easyid3 import EasyID3
from mutagen.mp3 import MP3
import io
import sys
#sys.stdout = io.TextIOWrapper(sys.stdout.buffer,encoding='utf-8')

count = 0
path = '../bgm/mp3/'
result = []

def findMessageByName(fileName):
    mp3info = MP3(fileName, ID3=EasyID3)
    try:
        temp = mp3info['title']
    except:
        temp=''
    mp3info.clear()
    return str(temp)[2:-2]#输出格式为[u'**** 

for item in os.listdir(path):
    #count = count + 1
    #if count <= 2:
    #    continue
    #print('###########'+item)
    if item.split('.')[1] == 'json' :
        continue
    try:
        temp = {'group': item[:-4], 'text': findMessageByName(path + item)}
        result.append(temp)
    except Exception as err:
        #print (err)
        pass

print(result)
