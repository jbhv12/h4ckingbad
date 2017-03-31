//[50,40]
/*Don't take Jesse for a complete idiot. He's not showing you his source this time.*/

#include<stdio.h>
#include<string.h>
void rotate(char *str,int n) 
{
  int i =0;
  for(i=0;str && str[i]; ++i) 
  {
    if(str[i] >= 'a' && (str[i]+n) <='z')
    {
      str[i] = str[i]+n;       
    }
  }
}

int main(){
	char f[]="edslohv";
	rotate(f,10);
	char inp[200];
	char pass[] = "lol";
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
