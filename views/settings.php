	<div class="container">
		<div class="row">

			<!-- Page Navigation -->
			<div class="col-md-3" role="complementary">
				<ul class="nav affix-top">
					<li class="active"><a href="#">General</a></li>
					<li class="active"><a href="#">Cache</a></li>
					<li class="active"><a href="#">Database</a></li>
					</ul>
			</div>
			<!--/Page Navigation -->

			<!-- Main Content -->
			<div class="col-md-9" role="main">
				<div class="page-header">
					<h1><?php echo $this->container_title; ?></h1>
				</div>
				<?php
				foreach($this->alerts as $key => $value) {
					echo '<div class="alert alert-' . $key . '">' . $value . '.</div>' . "\n";
				}
				?>
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?action=settings'; ?>">
					<div class="form-group <?php echo $this->errors['eyeqendpoint']?'has-error':''; ?>">
						<label class="control-label" for="eyeqendpoint">Endpoint URL</label>
						<input type="url" class="form-control" id="eyeqendpoint" name="eyeqendpoint"
							placeholder="https://c123456.ipg.web.cddbp.net/webapi/xml/1.0/" required
							value="<?php echo $this->eyeqendpoint; ?>">
						<p class="help-block">When saving, we will perform a simple check if the URL can be reached and is responding.</p>
					</div>
					<div class="form-group <?php echo $this->errors['eyeqclientid']?'has-error':''; ?>">
						<label class="control-label" for="eyeqclientid">Client ID</label> <input type="text"
							class="form-control" id="eyeqclientid" name="eyeqclientid"
							placeholder="123456-FE66D9A329DE5700E312A2CFFBEC981D" required
							value="<?php echo $this->eyeqclientid; ?>">
					</div>
					<div class="form-group <?php echo $this->errors['eyequserid']?'has-error':''; ?>">
						<label class="control-label" for="eyequserid">User ID</label>
						<input type="text" class="form-control" id="eyequserid" name="eyequserid"
							placeholder="262424770123438304-793BE7F4815D9C81F1234E1E54BFEE18"
							value="<?php echo $this->eyequserid; ?>">
						<p class="help-block">Leave empty and we will create a new User ID when saving.</p>
					</div>
					<div class="form-group <?php echo $this->errors['eyeqappinfo']?'has-error':''; ?>">
						<label class="control-label" for="eyeqappinfo">Application Info</label> <input type="text"
							class="form-control" id="eyeqappinfo" name="eyeqappinfo"
							placeholder="app=&quot;Name of your app&quot;,os=&quot;PHP&quot;,mfg=&quot;Your name&quot;,sdk=&quot;Web API&quot;"
							value="<?php echo $this->eyeqappinfo; ?>">
						<p class="help-block">Optionally provide some information about your application.</p>
					</div>
					<button type="submit" class="btn btn-primary">Check &amp; Save</button>
				</form>
			</div>
			<!--/Main Content -->

		</div>
		<!--/.row -->
	</div>
	<!--/.container --> 