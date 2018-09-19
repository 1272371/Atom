package com.company;

import org.junit.Test;

import java.util.ArrayList;
import java.util.Random;

import static org.junit.Assert.*;

public class PredictTest {
    Random r = new Random();
    String output = "Pass";

    @Test
    public void getOutput()  throws Exception{
        ArrayList<Integer>Marks = new ArrayList<>();
        for(int i=0;i<10;i++){
            Marks.add(r.nextInt(99));
        }
        int sum = 0;
        Predict t = new Predict(output,Marks);
        for (int j:Marks) {
            sum+=j;
        }
        sum/=10;
        if(sum<50){output="Fail";}
        System.out.println("Avarage : "+sum);
        System.out.println("output from Actual : "+output);
        System.out.println("Count Fail :"+t.getCount());
        System.out.println("output from Expected : "+t.getOutput());
        System.out.println("Student Marks are : ");
        for(int v:Marks) System.out.print(v+",");
       assertEquals(output,t.getOutput());
    }
}