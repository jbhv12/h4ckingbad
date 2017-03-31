//[150,120,100]
/*This time again, Jesse needs to store his secret data. Remembering his previous mistakes he decided to make some changes in the code. He felt proud of himself as he secured his program(just a little bit!) However, being a noob he overlooked a possible vulnerability and was again brought down by Hank.

Again, find out the vulnerability and fetch the secret for yourself.
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int check_authentication(char *password) {
	char password_buffer[16];
	int auth_flag = 0;
	strcpy(password_buffer, password);
	if(strcmp(password_buffer, "outgrabe") == 0)
		auth_flag = 1;
	return auth_flag;
}
int main(int argc, char *argv[]) {
	if(argc < 2) {
		printf("Usage: %s <password>\nGimme somthin to work with", argv[0]);
		exit(0);
	}
	if(check_authentication(argv[1])) {
		printf("\n-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
		printf("flag");
		printf("-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
	} else {
		printf("\nno flag for you. bhag yaha se!");
   }
}
	
