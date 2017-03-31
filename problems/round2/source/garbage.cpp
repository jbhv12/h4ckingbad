//[50,40,30]
/*Jesse messed up.(again!). He wrote a code that dumps out some strings. Although, they look like garbage(most of them are), there is one string in perticular which is higly important to Heisenberg. Find out the secret flag among other garbage strings.
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
using namespace std;

char *FLAG="lolwa1flaG23";
int TOTALFAKES=25;

char* gen_random(const int len);
int main(){

srand(time(NULL));

int low_num=1,hi_num=TOTALFAKES,lenwa=strlen(FLAG);
int r = (rand() % (hi_num - low_num)) + low_num;

for(int t=0;t<=TOTALFAKES;t++) 
if (t==r)	printf("%s\n",FLAG);
else fprintf( stderr, "%s\n",gen_random(lenwa));

return 0;

}



char* gen_random(const int len) {
char* s=new char[len+1];
static const char alphanum[] =
        "0123456789"
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
        "abcdefghijklmnopqrstuvwxyz";

    for (int i = 0; i < len; ++i) {
        s[i] = alphanum[rand() % (sizeof(alphanum) - 1)];
    }

    s[len] = 0;
	return s;
}
