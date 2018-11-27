import numpy as np
import sys

def running_mean(x):
    cumsum = np.cumsum(x)
    return cumsum / np.arange(1, len(cumsum) + 1)


def predict(course, marks):
    N = len(marks)
    marks = running_mean(marks)
    xdata = np.arange(0, N)
    y_noise = 1 * np.random.normal(size=xdata.size)
    ydata = marks + y_noise
    p = np.poly1d(np.polyfit(xdata, ydata, 1))
    pred = p(N+1) + 15 + 2 * np.random.normal()
    pred = min(100, max(0, pred))
    return pred


if __name__ == '__main__':
    course = sys.argv[1]
    marks = [float(sys.argv[i]) for i in range(2, len(sys.argv))]
    print(predict(course, marks))
