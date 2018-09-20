/*
	A dummy file for the algorithm to be implemented later
*/
import javax.swing.*;
import javax.swing.text.html.Option;
import  java.awt.*;
import java.applet.*;
public class Algo extends Applet{
    public void init(){

    }
    public void start(){
        JOptionPane.showMessageDialog(null,"Started");
    }
/*    public void algo(){
        int a = 0;
        if (Math.random() < 0.5)a = 0;
        else a = 1;
        //return a;
    }*/
    public void paint(Graphics  g){
        g.drawOval(0,0,250,100);
        g.setColor(Color.cyan);
        g.drawString("testing ",10,50);
        JOptionPane.showMessageDialog(null,"worked");
    }
}
