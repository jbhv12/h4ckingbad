//[50,40,30]
/*
Tuco is a black hat hacker.This time, Tuco claim to have written a perfect code and challenges Heisenberg to break it. He hid a secret inside some logical statements which are according to him, are impossible to get executed. How dare he challenge the almighty Heisenberg! Help Heisenbeg in fetching the flag and bring Tuco down! 
*/

#include<stdio.h>
#include<stdlib.h>
int main(){
	int n;
	unsigned int u;
	print"enter anything..it won't matter: ");
	scanf("%d",&n);
	if(n>1024){
		printf("you thought it'd work.but somehow it just doesn't!");
		exit(1);
	}
	u=n;
	if(u>2048){
		char f[]="flag";
	       	printf(f);
	}
	return 0;
}
