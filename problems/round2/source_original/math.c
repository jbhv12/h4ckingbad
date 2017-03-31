//[50,40]
/*Jesse is boasting about some math he learned. He shows off his skills by writing a code and calls everyone noob who can't understand it. Use your expert skills to find the flag and hit that kid in the face!
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

int main(void){
           int val,n;
	   char f[]="wnclsopr";
	   rotate(f,14);
           val =0x7ffffe76;
           printf("val = %d (0x%x)\n", val, val);
	   printf("enter value of n: ");
	   scanf("%d",&n);
	   val+=n;
	   if(val==-2147483648)printf(f);
	   else{printf("tum se na ho payega!\n");}
           return 0;
   }

