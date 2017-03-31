//[150,100]
/* Jesse proves his stupidity by writting the following code */
#include<stdio.h>
#include<stdlib.h>
int main(){
	int pin=7321,inp;
	scanf("%d",&inp);
	if(pin==inp)printf("flag");
	else{
		printf("wrrong");
		exit(1);
	}
	return 0;
}

