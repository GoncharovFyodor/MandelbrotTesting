import sys, time
stdout = sys.stdout

BAILOUT = 16
#MAX_ITERATIONS = 10000

class Iterator:
    def __init__(self):
              
        max_iter=100
        avg=0.0
        while max_iter<=100000:
            file_res = open("result.txt", "a")  
            for z in range(0,10):
                t = time.time()                
                print('Rendering...')
                for y in range(-39, 39):
                    stdout.write('\n')
                    for x in range(-39, 39):
                        i = self.mandelbrot(x / 40.0, y / 40.0,max_iter)
                        
                        if i == 0:
                            stdout.write('*')
                        else:
                            stdout.write(' ')
                dt=time.time() - t
                print('\n',z,' MAX_ITERATIONS=',max_iter,'Python Elapsed %.02f' % (dt))
                avg=avg+dt
            avg=avg/10.0
            print('\n',avg)
            max_iter=max_iter*10
            file_res.write(repr((repr(avg),'\n')))
            file_res.close()
    def mandelbrot(self, x, y,max_iter):
        cr = y - 0.5
        ci = x
        zi = 0.0
        zr = 0.0
        i = 0

        while True:
            i += 1
            temp = zr * zi
            zr2 = zr * zr
            zi2 = zi * zi
            zr = zr2 - zi2 + cr
            zi = temp + temp + ci

            if zi2 + zr2 > BAILOUT:
                return i
            if i > max_iter:
                return 0
Iterator()
