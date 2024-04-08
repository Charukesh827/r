library(ggplot2)

f1<-function(x){return((24-6*x)/4)}
f2<-function(x){return((6-x)/2)}
f3<-function(x){return(1+x)}
f4<-function(x){return(2)}

x<-seq(0,10,length.out = 100)

df <- data.frame(x=x,y1=f1(x),y2=f2(x),y3=f3(x),y4=f4(x))

ggplot(df,aes(x=x))+
  geom_line(aes(y=y1),colour="green")+
  geom_line(aes(y=y2),colour="red")+
  geom_line(aes(y=y3),colour="blue")+
  geom_line(aes(y=y4),colour="yellow")+
  geom_ribbon(aes(ymin=0 , ymax=y1) , fill="green", alpha=0.4)+
  geom_ribbon(aes(ymin=0 , ymax=y2) , fill="red" , alpha=0.4)+
  geom_ribbon(aes(ymin=0 , ymax=y3) , fill="blue" , alpha=0.4)+
  geom_ribbon(aes(ymin=0 , ymax=y4) , fill="Yellow" , alpha=0.4)+
  coord_cartesian(xlim = c(0,7), ylim = c(0,7))+
  annotate("text",x=0,y=0,label="(0,0)",vjust=-1)+
  annotate("point",x=0,y=0)+
  annotate("text",x=1,y=2,label="(1,2)",vjust=-1)+
  annotate("point",x=1,y=2)
  
  
