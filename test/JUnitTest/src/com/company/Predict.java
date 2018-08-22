package com.company;
import java.util.ArrayList;

public class Predict {
private String output;
private Integer count=0;
private ArrayList<Integer>Marks;

   public Predict(String output, ArrayList<Integer> Marks) {
       this.output = output;
       this.Marks = Marks;
       setCount();
   }

    public void setCount(){
        for (Integer mark : Marks) {
            if(mark<40)count++;
        }
    }

    public String getOutput() {
        return (count<5)?"Pass":"Fail";
    }

    public Integer getCount() {
        return count;
    }
}
