#include <stdio.h>
#pragma push once 
int main(){
#pragma pack(1)
  struct {
    char buf[20];
    long val;//=0x41414141;
  } s;
#pragma pack()
  s.val = 0x41414141;
  printf("Correct val's value from 0x41414141 -> 0xdeadbeef!\n");
  printf("Here is your chance: ");
  scanf("%24s",&s.buf);

  printf("buf: %s\n",s.buf);
  printf("val: 0x%08x\n",s.val);

  if(s.val==0xdeadbeef)
    system("/bin/sh");
  else {
    printf("WAY OFF!!!!\n");
    exit(1);
  }

  return 0;
}
