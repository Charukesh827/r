x<- matrix(as.integer(scan("DUU_data.txt",'r'))
           ,nrow=4,byrow=TRUE)

mini<-which.min(rowMeans(x))

cat("The optimum solution (using laplace): ",mini,'\n')


mini=apply(x,1,max)
cat("The optimum solution using minmax is: ",which.min(mini),'\n')

savage<-x
regret<-which.min(apply(sweep(savage,2,apply(savage,2,min)),1,max))
cat("The optimum solution using savage-regret is: ",regret,'\n')

alpha=0.5
result<-apply(x,1,min)*alpha+apply(x,1,max)*(1-alpha)
result<-which(result==min(result))
cat("Having alph=0.5 using harwicz the optimal solution is: ",result)
