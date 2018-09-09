import os
import re
import fileinput
import random
import shutil
import json
order=('png','jpg','jpeg','bmp','gif')
id={}
idn=-1
# id_png = 0
# id_jpg = 0
# id_jpeg = 0
# id_bmp = 0

name = ''
i = []

def checkForNum (str):
    if os.path.exists('./'+str):
        file = open('./'+str+'/res.json', 'r')
        res = file.read()
        res = json.loads(res)
        id[str] = res[str]
        file.close()
def writeLog (string):
    file = open(string+'/res.json', 'w')
    if string=='.':
        target=str(id)
        target=target.replace('\'','\"')
        file.write(target)
    else:
        file.write('{\"'+string+'\":'+str(id[string])+'}')
    file.close()

##########let's start
print('1/5 start read the data..')

for value in order:
    checkForNum(value)

print('2/5 xia ji er rename...')

for i in os.listdir('.'):
    if i.find('.')==-1:
        continue
    name = i.split('.')[1]
    for value in order:
        if name == value:
            os.rename('./' + i, './' + str(int(random.random()*10000000000)) + '.' + name)
            if not os.path.exists('./'+name):
                id[name]=0
                os.makedirs('./'+name)

print('3/5 encoding...')

for i in os.listdir("."):
    if i.find('.')==-1 or i[0]=='.' :
        continue
    name = i.split('.')[1]
    if name=='':
        continue
    for value in order:
        if name == value:
            print(i + '\t -> ' + str(id[name]) + '.' + name)
            os.rename('./' + i, './' + str(id[name]) + '.' + name)
            shutil.move("./"+ str(id[name]) + '.' + name,"./"+name+"/"+str(id[name]) + '.' + name)
            print(str(id[name]) + '.' + name+' -> '+"./"+name+'/')
            id[name] += 1
print('4/5 writing log...')

for value in id.keys():
    writeLog(value)
writeLog('.')

print('5/5 complete')

#os.system('PAUSE')
