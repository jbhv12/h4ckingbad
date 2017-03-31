//[50,40,30]
/*Unlike Jesse, Gus is smart enough not to store his secret data in stack, he uses heap instead. He designes a complex logica structure which cannot be manipulated easily.His rival Heisenger must obtain this secret data in order to bring him down.Help him out!
*/
//make hard:remove printf,take dif as inp
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>

#define BUFSIZE 16

int main()
{
	int OVERSIZE ;
	unsigned long diff;
	char *buf1 = (char *)malloc(BUFSIZE), *buf2 = (char *)malloc(BUFSIZE);

	diff = (unsigned long)buf2 - (unsigned long)buf1;
	printf("buf1 = %p, buf2 = %p,\n", buf1, buf2);
	printf("enter value of OVERSIZE: ");
	scanf("%d",&OVERSIZE);

	memset(buf2, 'A', BUFSIZE-1), buf2[BUFSIZE-1] = '\0';

	memset(buf1, 'B', (unsigned int)(OVERSIZE));

	int r = strcmp(buf2,"BBBBBBBBBBBBBBB");
	char f[]="flag";
	if(r==0)printf(f);
	else{printf("you thought it'd work. But somehow it just doesn't!\n");}

	return 0;
}
