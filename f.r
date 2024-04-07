library(numDeriv)
f<-function(x){
  return(x[1]-x[2]+2*x[1]^2+2*x[1]*x[2]+x[2]^2)
}

gradient<-function(f,x){
  return(grad(func=f,x=x))
}

grad_f<-function(x){
  return(gradient(f,x))
}

fletcher_reeves<-function(f,grad_f,x){
  x<-x0
  cap_s<- -grad_f(x)
  
  grad<-grad_f(x)
  grad <- round(grad, 4)
  cat("f:",grad," - x:",x," - s:",cap_s,"\n")
  iter<-0
  while(all(grad!=0)){
    if(iter!=0){
      a<-sum(grad^2)/sum(cap_s^2)
      b<- -grad+a*cap_s
      cap_s<-b
    }
    line_search<-function(lambda)f(x+lambda*cap_s)
    opt<-optimize(f=line_search, interval = c(0,10) , maximum =FALSE)
    lambda<-opt$minimum
    
    x<-x+lambda*cap_s
    iter<-iter+1
    grad<-grad_f(x)
    grad <- round(grad, 4)
    cat("f:",grad," - x:",x," - s:",cap_s,"\n")
  }
  return(list(x = x, value=f(x)))
}

x0<-c(0,0)

result<-fletcher_reeves(f,grad_f,x0)
cat("\nMinimumpoint:", result$x,"\n")
cat("Minimumvalue:", result$value,"\n")
#cat("Number of iterations:", result$iterations,"\n")

