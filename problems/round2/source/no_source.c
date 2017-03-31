//[50,40,30]
/*Jesse learned something from his previous blunders: He always gets in trouble when somebody sees his source code and hacks it. So now he decied not to leave his source open for everyone to see. Still, Saul manages to grab the password and fetch the flag. Turns out, the source is still lying around somewhere. Find out the source and then fetching the flag should be easy.
*/
#include<stdio.h>
int main(){
	char c[]="secret";
	char f[]="flag";
	char buf[10];
	printf("enter password: ");
	gets(buf);
	if(strcmp(buf,c)==0)printf(f);
	else printf("Wrong!");
return 0;
}
