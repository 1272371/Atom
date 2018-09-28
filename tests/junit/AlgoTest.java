import static org.junit.jupiter.api.Assertions.assertEquals;

import org.junit.jupiter.api.Test;
import ../java/src/Algo.java
public class AlgoTest{
    @Test
    public void AlgoTest() {
        Algo tester = new Algo(); // algo is tested

        // assert statements
        assertEquals(1, tester.algo(), "1expected value must be 1");
        }
}