{include file="header.tpl"}
{include file="navbar.tpl"}
{include file="addNewPage.tpl"}
{include file="register.tpl"}
{include file="login.tpl"}

<div class="container-fluid footer-min-height footer-min">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit">
				
				{include file="social-tabs-pages.tpl"}
				<div class="social-pages-container twitter-container">
					<hr/>
					<br/>
					<p class="txt">Depending on your level, you can add a certain amount of points per like.  To see our ranking , click <a class="term-link" href="{$URL}about/help">here</a> .</p>
					<br/>
					
					<div id="accordion">
						<h3><a href="#">Section 1</a></h3>
						<div>
							
							<div class="input-prepend">
				                <span class="add-on">Select points per like:</span>
				                	<select class="span1" size="1">
				                		<option>1</option>
				                		<option>2</option>
				                		<option>3</option>
				                		<option>4</option>
				                		<option>5</option>
				                		<option>6</option>
				                		<option>7</option>
				                		<option>8</option>
				                		<option>9</option>
				                	</select>
				            </div>
				            
				            <div class="input-prepend">
				            	<span class="add-on">Insert the number of clicks:</span>
				                <input type="text" class="input-xlarge span1"><span class="btn btn-danger" style="margin-top:-8px; margin-left:5px;">20 Credits Maximum</span>
				            </div>
				            	<input type="submit" class="btn" value="Submit">
				            	<hr/><br/><br/>
				            	<p>Statistics</p>
				            	<span class="btn">100 Likes Received</span>
				            	<span class="btn">600 Points Assigned</span>
				            	<span class="btn">10 Points Left</span>
				            	<hr/>
				            	<input type="submit" class="btn btn-danger" value="Reset Credits">
				            	<input type="submit" class="btn btn-danger" value="Delete Page">
						</div>
					</div>

				</div>
            </div>
		</div> 
	</div>
</div>

{include file="footer.tpl"}