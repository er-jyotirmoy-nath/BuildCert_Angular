<div id="addtmv2" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add TMV2 Record</h4>
			</div>
			<div class="modal-body" id="tmv2_add_res"></div>
			<div class="modal-footer">
			<div style="float: left;"><span id="res_tmv2"></span></div><div style="float: right;"><input type="button" class="btn btn-primary" id="add_tmv2" value="Add Approval">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
			
			</div>
		</div>

	</div>
</div>
<div id="addtmv3" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add TMV3 Record</h4>
			</div>
			<div class="modal-body" id="tmv3_add_res"></div>
			<div class="modal-footer">
			<div style="float: left;"><span id="res_tmv3"></span></div><div style="float: right;"><input type="button" class="btn btn-primary" id="add_tmv3" value="Add Approval">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
</div>
<div id="addcias" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add CIAS Record - <span id="cias_res"></span></h4>
			</div>
			<div class="modal-body" id="cias_add_res"></div>
			<div class="modal-footer">
			<input type="button" class="btn btn-primary" id="add_cias" value="Add Approval">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<div id="addbuildcert" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add BUILDCERT Record - <span id="buildcert_res"></span></h4>
			</div>
			<div class="modal-body" id="buildcert_add_res"></div>
			<div class="modal-footer">
			<input type="button" class="btn btn-primary" id="add_buildcert" value="Add Approval">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<div id="adddtc" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add DTC Record - <span id="dtc_res"></span></h4>
			</div>
			<div class="modal-body" id="dtc_add_res"></div>
			<div class="modal-footer">
			<input type="button" class="btn btn-primary" id="add_dtc" value="Add Approval">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
  <div id="cerissue" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Certificate Issue for: <span id="sample"></span></h4>
			</div>
                        <div class="modal-body" id="cert_show" >

                        </div>
			<div class="modal-footer">
			<!-- <input type="button" class="btn btn-primary" id="add_buildcert" value="Add Approval"> -->
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
 <div id="downloadmod" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Downloads Link - <span id="down_res"></span></h4>
			</div>
                        <div class="modal-body" id="cert_show" >
                            <form id="addlinkfr" name="addlinkfr" >
                            <div class="form-group input-group"><span class="input-group-addon">Section:</span><select class="form-control" id="section">
                                                <option>CIAS</option>
                                                <option>DTC</option>
                                                <option>TMV2</option>
                                                <option>TMV3</option>
                                                <option>Certification</option>
                                                <option>Additional Information</option>
                             </select></div>
                            <div class="form-group input-group"><span class="input-group-addon">Title:</span><input type="text" id="down_title" class="form-control" placeholder="Link Title"></div>
                            <div class="form-group input-group"><span class="input-group-addon">Name:</span><input type="text"  id="down_name" class="form-control" placeholder="Link Name"></div>
                            <div class="form-group input-group">
                                <select class="form-control" id="optradio">
                                <option value="f" >File</option>
                                <option value="l">Link</option>                           
                              </select>
                            </div>
                            <div class="form-group input-group"><span class="input-group-addon">Link:</span><input type="text"  id="down_link"class="form-control" placeholder="Link Hyperlink"></div>
                            <div class="form-group"><label>File Upload</label><input type="file" id="down_file"><span id="up_res"></span></div></form>
                        </div>
			<div class="modal-footer">
                            <input type="button" class="btn btn-primary" id="add_link" value="Add Link"><span id="down_res"></span>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>