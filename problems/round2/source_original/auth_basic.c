//[30,15]
/*Jesse had some secret data. Instead of storing it as a plain text file, he thought better and wrote a c program which reveals the secret data upon entering correct password. However, this program was highly insecure. It took just few seconds for Hank to break the binary and fetch the secret and bring him down. 

  Your job is to find out where he screwed up and find the secret for yourself.
  */
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
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

int check_authentication(char *password) {
	int auth_flag = 0;
	char password_buffer[16];
	strcpy(password_buffer, password);
	if(strcmp(password_buffer, "outgrabe") == 0)
		auth_flag = 1;
	return auth_flag;
}
int main(int argc, char *argv[]) {
	if(argc < 2) {
		printf("Usage: %s <password>\ngimme something to work with", argv[0]);
		exit(0);
	}
	char f[]="gomwxziqv";
	rotate(f,10);
	if(check_authentication(argv[1])) {
		printf("\n-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
		printf(f);
		printf("-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
	} else {
		printf("\nNope.You don't mess around with Jesse!\n");
	}
}


