<?xml version="1.0" encoding="ISO-8859-1"?>
					  		<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 							 <xsl:template match="class">
   							  <html>
     								 <head>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        								<title>
        								  Class <xsl:value-of select="@name"/>
        								</title>
     								 </head>
      								 <body>
     								 	<b>Class: </b>
        								 <xsl:value-of select="@name"/>
        								 <br/>
       									 <b>Modifier: </b>
        								 <xsl:value-of select="@mod"/>
        								 <br/>
        								 <b>Members:</b><br/>
                         							<xsl:for-each select="member">
                          								<xsl:value-of select="."/>
                        							</xsl:for-each>
       									 <br/>
        								 <b>Variables:</b>
     								</body>
   							  </html>
  							 </xsl:template>
 						    </xsl:stylesheet>