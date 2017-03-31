#include<stdio.h>
int main(){
	struct fraction{
		int num;
		int denom;
		char c;
	};
	struct fraction pi;
	pi.num=1;
	pi.denom=2;
	struct fraction* n = ((struct fraction*)&pi.denom)->denom=65;
	printf("%d",n->denom);


	int x = ((struct fraction*)&pi.denom)->num;
	//auto y =((struct fraction*)&pi.denom)[0].denom;

//	printf("%d\n",k);
	return 0;
}

