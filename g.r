# Load the ggplot2 package
library(ggplot2)

# Define the functions for the inequalities
f1 <- function(x) { return(5-x) }
f2 <- function(x) { return((12-3*x)/2) }
#f3 <- function(x) { x^3 }

# Create a sequence of x values
x <- seq(0, 10, length.out=100)

# Create a data frame with the x values and corresponding y values
#df <- data.frame(x = x, y1 = f1(x), y2 = f2(x), y3 = f3(x))
df <- data.frame(x = x, y = f1(x), y2 = f2(x))
# Plot the inequalities and shade the regions bounded by them
ggplot(df, aes(x = x)) +
  geom_ribbon(aes(ymin = y, ymax = Inf), fill = "red", alpha = 0.3) +
  geom_ribbon(aes(ymin = -Inf, ymax = y2), fill = "green", alpha = 0.3) +
  geom_line(aes(y = y), colour = "red") +
  geom_line(aes(y = y2), colour = "green") +
  annotate("point", x=2,y=3,colour = "black")+
  annotate("text",x=2,y=3,label="(2,3)",vjust=-1)+
  xlab("This is x")+
  ylab("This is y")+
  ggtitle("Title")+
  coord_cartesian(xlim= c(0,7), ylim=c(0,7))
  
