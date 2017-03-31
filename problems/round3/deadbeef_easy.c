#include <stdio.h>
 
int main(){
int val=0x41414141;
char buf[20];
 
printf("Correct val's value from 0x41414141 -> 0xdeadbeef!\n");
printf("Here is your chance: ");
scanf("%24s",&buf);
 
printf("buf: %s\n",buf);
printf("val: 0x%08x\n",val);
printf("%d",val);
 
if(val==0xdeadbeef)
	printf("flag:t83kcFSF");
else {
printf(" WAY OFF!!!!\n");
}
 
return 0;
}
