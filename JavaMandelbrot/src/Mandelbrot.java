import java.util.*;
import java.io.*;
class Main
{
    static int BAILOUT = 16;
    //static int MAX_ITERATIONS = 1000000;

    private static int iterate(float x, float y,long max_iter)
    {
        float cr = y-0.5f;
        float ci = x;
        float zi = 0.0f;
        float zr = 0.0f;
        int i = 0;
        while (true) {
            i++;
            float temp = zr * zi;
            float zr2 = zr * zr;
            float zi2 = zi * zi;
            zr = zr2 - zi2 + cr;
            zi = temp + temp + ci;
            if (zi2 + zr2 > BAILOUT)
                return i;
            if (i > max_iter)
                return 0;
        }
    }

    public static void main(String args[])
    {
        String avgs="";
        double avg=0;
        for(long max_iter=100;max_iter<=1000000;max_iter*=10){
            for(int z=0;z<=9;z++){
                Date d1 = new Date();
                int x,y;
                for (y = -39; y < 39; y++) {
                    System.out.print("\n");
                    for (x = -39; x < 39; x++) {
                        if (iterate(x/40.0f,y/40.0f,max_iter) == 0)
                            System.out.print("*");
                        else
                            System.out.print(" ");
                    }
                }
                Date d2 = new Date();
                long diff = d2.getTime() - d1.getTime();
                avg+=(double)(diff/1000.0f);
                System.out.println("\nz="+z+", MAX ITERATIONS "+max_iter+", Java Elapsed " + diff/1000.0f);
            }
            avg/=10;
            System.out.println(avg);
            avgs=avgs+"\n"+avg;  
        }
        try(FileWriter writer = new FileWriter("result.txt"))
            {
                writer.write(avgs);
            }
            catch(IOException ex){
                System.out.println(ex.getMessage());
            } 
    }
}
