library(lpSolve)

obj<-c(5,4)

con<-matrix(c(6,4,1,2,-1,1,0,1),nrow = 4,byrow = TRUE)

rhs<-c(24,6,1,2)

dir<-c("<=","<=","<=","<=")

result<-lp("max",obj,con,dir,rhs)

print(result)