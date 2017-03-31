//[50,40,10]
/*Apart from being a badass hacker, Heisenberg is also a great teacher. He challenges his student with this little yet complex code. Jesse want to prove his worth by cracking this problem. Help him out.
*/
#include<stdio.h>
int main(){
	char f[]="flag";
	int a = 320,r=1,n;
	char *ptr;
	ptr =( char *)&a;
	scanf("%d",&n);
	for(int _=0;_<n;_++)r<<=1;
	if(r==*ptr)printf(f);
	else{printf("try harder!");}
	return 0;
}
