#include <stdio.h>
#include <sys/time.h>

#define BAILOUT 16
#define MAX_ITERATIONS 10000

int mandelbrot(double x, double y, long int max_iter)
{
	double cr = y - 0.5;
	double ci = x;
	double zi = 0.0;
	double zr = 0.0;
	int i = 0;

	while(1) {
		i ++;
		double temp = zr * zi;
		double zr2 = zr * zr;
		double zi2 = zi * zi;
		zr = zr2 - zi2 + cr;
		zi = temp + temp + ci;
		if (zi2 + zr2 > BAILOUT)
			return i;
		if (i > max_iter)
			return 0;
	}

}

int main (int argc, const char * argv[]) {
    double avg=0.000;
    FILE* f = fopen("result.txt","w");
    for(long int max_iter=100;max_iter<=1000000;max_iter*=10){
        for(int z=0;z<=9;++z){
        struct timeval aTv;
        gettimeofday(&aTv, NULL);
        long init_time = aTv.tv_sec;
        long init_usec = aTv.tv_usec;

        int x,y;
        for (y = -39; y < 39; y++) {
            printf("\n");
            for (x = -39; x < 39; x++) {
                int i = mandelbrot(x/40.0, y/40.0,max_iter);
                if (i==0)
                    printf("*");
                else
                    printf(" ");
            }
        }
        printf ("\n");

        gettimeofday(&aTv,NULL);
        double query_time = (aTv.tv_sec - init_time) + (double)(aTv.tv_usec - init_usec)/1000000.0;
        printf("MAX_ITERATIONS=%d, C Elapsed %0.3f\n", max_iter, query_time);
        fprintf(f, "%d, MAX_ITERATIONS=%d, C Elapsed %0.3f\n",z, max_iter, query_time);
        avg+=query_time;
        }
        avg=avg/10.000;
        printf("%0.3f\n",avg);
        fprintf(f, "%0.3f\n",avg);
    }
    fclose(f);
	int ender;
	scanf("%d",&ender);
    return 0;
}
