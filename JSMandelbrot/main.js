/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function Test() {
    var self = this;
    
    self.BAILOUT = 16;
    self.MAX_ITERATIONS = 100;    
    self.startTime = 0;
    self.finishTime = 0;
    self.rangeTime = 0;   
    
    self.Mandelbrot = function ()
    {
        var avgs="\n";
        for(self.MAX_ITERATIONS=100;self.MAX_ITERATIONS<=1000000;self.MAX_ITERATIONS*=10){
            var avg = 0.000;
            for(var z=0;z<=9;++z){
                self.startTime = (new Date()).getTime();
                for (y = -39; y < 39; y++) {
                    var temp = "";
                    for (x = -39; x < 39; x++) {
                        if (iterate(x/40.0,y/40.0,self.MAX_ITERATIONS) === 0) 
                            temp+="*"; //console.info("*");
                        else
                            temp+=" "; //console.info(" ");
                    }
                    console.log(temp);
                }
                self.finishTime = (new Date()).getTime();
                self.rangeTime = self.finishTime - self.startTime;
                console.log("\nJavaScript"+
                           "\nIteration: "+self.MAX_ITERATIONS+
                           "\nSeconds: "+(self.rangeTime)/1000);
                avg+=(self.rangeTime)/1000;
            }
            avg/=10;
            avgs=avgs+avg+"\n";
            console.log(avgs);
        }        
            fs=require("fs");
            fs.writeFileSync("result.txt", avgs,  "ascii");
    };   
    function iterate(x,y,max_iter)
    {
        var cr = y-0.5;
        var ci = x;
        var zr = 0.0;
        var zi = 0.0;
        var i = 0;
        while (true) {
            i++;
            temp = zr * zi;
            zr2 = zr * zr;
            zi2 = zi * zi;
            zr = zr2 - zi2 + cr;
            zi = temp + temp + ci;
            if (zi2 + zr2 > self.BAILOUT)
                return i;
            if (i > max_iter)
                return 0;
        }    
    } 
    
};
var Test = new Test();
Test.Mandelbrot();