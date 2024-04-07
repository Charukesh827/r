# Load the 'numDeriv' package for the 'grad' function
library(numDeriv)

# Define the function
f <- function(x) {
  return(x[1] - x[2] + 2*x[1]^2 + 2*x[1]*x[2] + x[2]^2)
}

# Compute the gradient of the function
compute_gradient <- function(f, x) {
  return(grad(func = f, x = x))
}

# Get the gradient of the function at a point
grad_f <- function(x) {
  return(compute_gradient(f, x))
}

# Implement the Cauchy method
cauchy <- function(f, grad_f, x0) {
  x <- x0
  grad <- grad_f(x)
  grad <- round(grad, 4)
  
  while (all(grad!=0)){
    
    s <- -grad_f(x)
    line_search <- function(lambda) f(x + lambda * s)
    opt <- optimize(f = line_search, interval = c(0, 10), maximum = FALSE)
    print(opt)
    lambda <- opt$minimum
    x <- x + lambda * s
    grad <- grad_f(x)
    grad <- round(grad, 4)
  }
  
  return(list(x = x, value = f(x)))
}

# Initialize the starting point
x0 <- c(0, 0)

# Apply the Cauchy method
result <- cauchy(f, grad_f, x0)

# Print the results
cat("\nMinimum point: ", round(result$x, 2), "\n")
cat("\nMinimum value: ", round(result$value, 2), "\n")
