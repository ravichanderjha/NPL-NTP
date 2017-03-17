<body onLoad="startclock()" onUnload="stopclock()">
        <form name="clock" onsubmit="0" action="#">
          <table summary="time" cellpadding="2" border="0" align="center">
            <tr>
              <td colspan="2" nowrap align="center">
                <font size="4"><b>Current time provided by NPL-INDIA</b></font>
              </td>
            </tr>
            <tr>
              <td align="right" nowrap>Indian Standard Time (IST) : </td>
              <td nowrap> <input class="txtbox" type="text" name="IST" size="40" value=""> </td>
            </tr>
            <tr>
              <td align="right" nowrap>Coordinated Universal Time (UTC) : </td>
              <td nowrap> <input class="txtbox" type="text" name="UTC" size="40" value=""> </td>
            </tr>
            <tr>
              <td align="right" nowrap>Local Standard Time (LST) : </td>
              <td nowrap> <input class="txtbox" type="text" name="LOC" size="40" value=""> </td>
            </tr>
            <tr>
              <td colspan="2" nowrap align="center"><br>
                <font size="4"><b>Your device's internal clock</b></font>
              </td>
            </tr>
            <tr>
              <td align="right" nowrap>Current time : </td>
              <td nowrap> <input class="txtbox" type="text" name="LOCAL" size="40" value=""> </td>
            </tr>
            <tr>
              <td align="right" nowrap>Difference from Local Standard Time : </td>
              <td nowrap> <input class="txtbox" type="text" name="offset" size="40" value=""> </td>
            </tr>
          </table>
        </form>
</body>

