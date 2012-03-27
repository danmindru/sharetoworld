{include file="header.tpl"}
{include file="navbar.tpl"}
{include file="addNewPage.tpl"}
{include file="register.tpl"}
{include file="login.tpl"}
 
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit">
				{if $flash}
					{if $flash.type == 'warning'}
						<a class="btn btn-warning" href="#">{$flash.message}</a>
					{elseif $flash.type == 'error'}
						<a class="btn btn-danger" href="#">{$flash.message}</a>
					{elseif $flash.type == 'success'}
						<a class="btn btn-success" href="#">{$flash.message}</a>
					{elseif $flash.type == 'info'}
						<a class="btn btn-info" href="#">{$flash.message}</a> 
					{/if}
				{/if}
				
               <div id="graphic">
   				   
   				   <div class="row-fluid">
	             	   <div class="span4 par-format">
			               <img id="arrow-add" src="{$URL_STATIC}img/arrow-add-new-page.png" alt="Add a new social page"/>
			               
			               <h4>Add Your Social Page</h4>
			               <p class="txt">You can add pages from facebook, twitter,</p>
			               <p class="txt">google, stumbleupon, pinterest and digg.</p>
	            		</div>
	               
						{include file="counter.tpl"}
	               
						<div class="span4 top-info par-format">
			               <img id="arrow-sign" src="{$URL_STATIC}img/arrow-sign-up.png" alt="Add a new social page"/>
			               
			               <h4>Sign Up - It's Free!</h4>
		                   <p class="txt">Have instant access to a audience </p>
		                   <p class="txt">you have never dreamed before.</p>
		                	<!-- <h2 class="hand-text">Testing Font</h2> -->
		              </div>
		          </div>    
                
                	<hr/>
                	
					<h1>Welcome to Share To World - a free service that connects people via  social networks: 
						share, to, world, social, networking, facebook, twitter, digg, google, stumble upon, linkedin, like, follow, tweet, share, pin, +1 or stumble - free, easy and safe. </h1>
              	  <div id="social-tree">
              	  	<img id="tree" src="{$URL_STATIC}img/tree-final.png" alt="Share to world social tree"/>
              	  	<h3 class="tree-text">Grow Your Social Network Tree</h3>
              	  	
              	  </div>
              	  <h2>Aquire a global audience and increase the number of followers on all your social networks.</h2>
              	  <hr/>
                  <br/>
                  
                  <div class="row-fluid">
	             	   <div class="span4 par-format-justify">
				            
				            <img id="question" src="{$URL_STATIC}img/question-final.png" alt="Share to world social tree"/>
				            <h5>What you get?</h5>
				            <p class="txt">
				            	The Share to World platform allows you to access a network formed by thousands of people across the globe.
				            	We bring a new, fresh and professional way to connect people via social networks. 
				            	It is the easiest way to connect your pages and increase the number of visits on your websites.
				            	Register now and get facebook likes, twitter followers, pluse one's and much more.
				            	</p>
				            
		               </div>
		               
		               <div class="span4 par-format-justify">
		               		<img id="globe" src="{$URL_STATIC}img/planet-final.png" alt="Share to world social tree"/>
				            <h5>Getting Global</h5>
				            <p class="txt">The good part has just got a lot better. You will instantly have a potential 
				            	audience formed not only by the your fans, but all of their connections as well. Each click you get can reach houndreds of people. 
				            	Building a network has just got a lot easier! 
				            	The users of Share to World will be connecting with your web page faster than you could ever imagine.
				            	
				            	
				            	Take your page to a global scale, for free!</p>
		               </div>
	                	
	                   <div class="span4 par-format-justify">  
		                   	<img id="gift" src="{$URL_STATIC}img/gift-final.png" alt="Share to world social tree"/>
		                   	<h5>No hidden pays</h5>
				            <p class="txt">What do you have to do in order to get access to this revolutionary service?
				            	Just register and add as many links as you want.
				            	Each click you will give is going to be in your advantage.
				            	The more users and clicks, the faster you can build a network.
				            	We don't have adds and do not charge you for our services.
				            	Being active is the best way you can reward us. 
				            	It will help you, us and others grow and build a network.
				            	</p>
		        	   </div>
		        	   
	               </div>
               </div>
                
			</div>
		</div> 
	</div>
</div>
{include file="footer.tpl"}