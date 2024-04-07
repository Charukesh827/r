library(lpSolve)
r<- c(14,47,31)
w<-c(1,3,2)
W<-4

m<-sapply(w,function(w) floor(W/w))

f<-matrix(0,nrow=length(w),ncol=W+1)

mm<-matrix(0,nrow=length(w),ncol = W+1)

for (i in 0:W) {
  rm<-c()
  for (j in 0:m[1]) {
    if(i>=j*w[1])
      rm<-c(rm,r[1]*j)
  }
  f[1,i+1]<-max(rm)
  mm[1,i+1]<-which.max(rm)-1
}

for (k in 2:length(w)){
  for (i in 0:W) {
    rm<-c()
    for (j in 0:m[k]) {
      if(i>=j*w[k])
        rm<-c(rm,r[k]*j+f[k-1,i-w[k]*j+1])
    }
    #print(rm)
    #cat(max(rm),"-",which.max(rm)-1,"\n")
    f[k,i+1]<-max(rm)
    mm[k,i+1]<-which.max(rm)-1
  }
}

cx<-0
cm<-0
cw<-0
nx<-0
nm<-0
nw<-0
cat("Final pic is: ")
for (i in length(w):1) {
  if(i==length(w)){
    cat(" ",mm[i,which.max(f[i,])]," ")
    cx<-which.max(f[i,])-1
    cw<-w[i]
    cm<-mm[i,which.max(f[i,])]
    nx<-cx
    nm<-cm
    nw<-cw
  }
  else{
    cat(mm[i,cx-cw*cm+1]," ")
    cx<-nx-nw*nm
    cw<-w[i]
    cm<-mm[i,nx-nw*nm+1]
    nx<-cx
    nm<-cm
    nw<-cw
  }
    
}