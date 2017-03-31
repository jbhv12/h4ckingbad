//[50,40,30]
/*Jesse learned something from his previous blunders: He always gets in trouble when somebody sees his source code and hacks it. So now he decied not to leave his source open for everyone to see. Still, Saul manages to grab the password and fetch the flag. Turns out, the source is still lying around somewhere. Find out the source and then fetching the flag should be easy.
*/
#include<stdio.h>
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
	char c[]="inp";
	char f[]="tioplmsa";
	rotate(f,13);
	char buf[10];
	printf("enter password: ");
	gets(buf);
	if(strcmp(buf,c)==0)printf(f);
	else printf("Wrong!");
return 0;
}
