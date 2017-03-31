//[30,15]
/*Heisenberg is an expert in computer programing. He wrote a highly popular Library function which handles user input.
Realizing how bad he is at coding, Jesse decides to use the legacy library function rather than writing his own. Without reading proper documentation, he made the same mistake allover again. This code was no better than his previous ones.
Again, your task is to find the secret flag that Jesse tries to hide so desperately.
*/
#include <stdio.h>
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

int grantAccess(char* s){
	return strcmp(s,"tucosalamaca") == 0;
}
int main () {
    int allow = 0;
    char username[8];
    printf("Enter your username, please: ");
    gets(username); 
    if (grantAccess(username)) {
        allow = 1;
    }
    if (allow != 0) { 
	char f[]="ncermlaq";
	rotate(f,9);
        printf(f);
    }
    return 0;
}
