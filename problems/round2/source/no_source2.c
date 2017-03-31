//[50,40]
/*Don't take Jesse for a complete idiot. He's not showing you his source this time.*/

#include<stdio.h>
#include<string.h>
int main(){
	char f[]="flag";
	char inp[200];
	char pass[] = "secret";
	scanf("%s",inp);
	int res = strcmp(inp,pass);
	if(res == 0){
		printf(f);
	}else{
		printf("you thout it'd work.but somehow it just doesn't!\n");
		exit(1);
	}

	return 0;
}
