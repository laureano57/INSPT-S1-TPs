<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">

<html lang="en" dir="ltr">

<head>
  <title>Sistemas de Computacion 1</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" href="../../css/styles.css" type="text/css"/>
  <script src="../../libs/jquery-3.4.1.min.js"></script>
</head>

<body>
  <div class="wrapper row1">
    <header id="header">
      <div id="hgroup">
        <h1>Sistemas de Computación I</h1>
        <h2>Trabajos prácticos de la materia</h2>
        <h2>Grupo 6 - Gonzalez, Olmedo, Stella</h2>
      </div>
      <nav>
        <ul>
          <li><a id="trabajos-practicos" href="/">Trabajos Prácticos</a></li>
          <li><a href="/consignas.html">Consignas</a></li>
        </ul>
      </nav>
    </header>
  </div>

  <div class="wrapper row2">
    <div id="container" class="clear" style="padding-bottom: 0px;">
      <div id="tp-wrapper">
        <div class="tp-header tp-header_tp4">
          <h1>Trabajo Práctico Nº 4</h1>
          <h2>Códigos de distancia unitaria</h2>
        </div>
        <h5 class="tp4-source">
          Fuente:
          <a target="_blank" href="http://www.ahok.de/en/hoklas-code.html">http://www.ahok.de/en/hoklas-code.html</a>
        </h5>
        <div class="container tp5-container" style="text-align-last: center;">
          <table id="tp-table" class="tp5-table1">
            <tr>
              <th>Posición</th>
              <th>Gray</th>
              <th>Glixon</th>
              <th colspan="2">O'Brien</th>
              <th>Exceso de Gray</th>
              <th colspan="2">Tompkins</th>
              <th>Libaw-Craig</th>
            </tr>
            <xsl:for-each select="data/codes/row">
              <tr>
                <td>
                  <xsl:value-of select="position"/><br/>
                </td>
                <td>
                  <xsl:value-of select="gray"/><br/>
                </td>
                <td>
                  <xsl:value-of select="glixon"/>
                </td>
                <td>
                  <xsl:value-of select="obrien"/>
                </td>
                <td>
                  <xsl:value-of select="obrien2"/>
                </td>
                <td>
                  <xsl:value-of select="excessGray"/>
                </td>
                <td>
                  <xsl:value-of select="tompkins"/>
                </td>
                <td>
                  <xsl:value-of select="tompkins2"/>
                </td>
                <td>
                  <xsl:value-of select="libaw-craig"/>
                </td>
              </tr>
            </xsl:for-each>
          </table>
          <table id="tp-table" class="tp5-table2">
            <tr>
              <th>Posición</th>
              <th colspan="2">Petherick</th>
            </tr>
            <xsl:for-each select="data/petherick-code/petherick-row">
              <tr>
                <td>
                  <xsl:value-of select="position"/><br/>
                </td>
                <td>
                  <xsl:value-of select="petherick0"/><br/>
                </td>
                <td>
                  <xsl:value-of select="petherick1"/><br/>
                </td>
              </tr>
            </xsl:for-each>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="wrapper row3">
    <footer id="footer">
      <p class="fl_left">INSPT - Tecnicatura Superior en Informática - 2019</p>
      <p class="validators">
        <a href="http://validator.w3.org/check?uri=referer">
          <img src="../../img/valid-html5.png" alt="Valid HTML 5" height="31" width="88"/>
        </a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
          <img src="../../img/vcss.gif" alt="CSS Válido!" height="31" width="88"/>
        </a>
      </p>
    </footer>
  </div>
</body>

</html>

</xsl:template>
</xsl:stylesheet>