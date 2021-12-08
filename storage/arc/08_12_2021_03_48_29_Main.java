/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pkg3d;

public class Main {
    static double pol[][]=new double[7][3];
 
    public static void main(String[] args) {
        original();
        System.out.println("Traslacion");
        traslacion();
        original();
        System.out.println("Escalacion");
        escalacion();
        original();
        System.out.println("Rotacion x");
        rotacion(1);
        original();
        System.out.println("Rotacion y");
        rotacion(2);
        original();
        System.out.println("Rotacion z");
        rotacion(3);
        original();
        System.out.println("corte");
        corte(1);
        original();
        System.out.println("reflexion");
        reflexion(2);
        original();
    }
    
    
    public static void original(){
        pol[0][0]=1;
        pol[0][1]=-3;
        pol[0][2]=0;
        pol[1][0]=3;
        pol[1][1]=-2;
        pol[1][2]=0;
        pol[2][0]=2;
        pol[2][1]=1;
        pol[2][2]=0;
        pol[3][0]=0;
        pol[3][1]=2;
        pol[3][2]=0;
        pol[4][0]=-2;
        pol[4][1]=1;
        pol[4][2]=0;
        pol[5][0]=-2;
        pol[5][1]=-2;
        pol[5][2]=0;
        pol[6][0]=-4;
        pol[6][1]=6;
        pol[6][2]=2;
  
    }
    
    public static void traslacion(){
        Transformaciones tras=new Transformaciones();
        pol=tras.traslacion(pol);
        
    }
    
    public static void rotacion(int t){
        Transformaciones tras=new Transformaciones();
        pol=tras.rotacion(pol,t);

    }
    
    public static void escalacion(){
        Transformaciones tras=new Transformaciones();
        pol=tras.escalacion(pol);

    }
    
    public static void corte(int t){
        Transformaciones tras=new Transformaciones();
        pol=tras.corte(pol,t);

    }
    
    public static void reflexion(int t){
       Transformaciones tras=new Transformaciones();
        pol=tras.reflexion(pol,t);

    }
    

}
