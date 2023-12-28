    <!-- 原本modal寫在index.html裡 會把modal獨立出來 因為沒辦法應付如果有300+以上的編輯 需建置300+ modal 不符效率 -->
	<!-- 所以把整段modal獨立出來 建置在後端(server) 由前端(client)提出需求是要新增/編輯 由後台判斷後產生(modal html)提供給前端, 然後再用js程式show出來 -->
	<!-- Modal -->
    <div class="modal fade" id="studentForm" tabindex="-1" aria-labelledby="studentFormLabel" aria-hidden="true">
		<!-- 調整id="studentForm"與aria-labelledby="studentFormLabel -->
    	<div class="modal-dialog modal-dialog-centered modal-lg">
			<!-- 調整modal-dialog-centered modal-lg 讓modal視窗在中間及使用最大框 -->
    		<div class="modal-content">
    			<div class="modal-header">
    				<h1 class="modal-title fs-5" id="studentFormLabel">
					<!-- 調整id="studentFormLabel"-->
    					<?= (isset($_GET['id'])) ? '編輯學生' : '新增學生'; ?></h1>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
    				<form action="./api/save.php" method="post" class="row p-3">
    					<?php
						if (isset($_GET['id'])) {
							include_once "db.php";
							$user = $Student->find($_GET['id']);
							extract($user);
							//回去查一下這個用法 但大概是把取得的陣列key變成變數(只能用在陣列形式是key:value)
						}
						?>
    					<div class="mb-3 col-6">
    						<label for="name" class="form-label">姓名</label>
    						<input type="text" class="form-control" name="name" id="name" value="<?= $name ?? ''; ?>">
    						<!-- 使用extract()節取出來的變數$name及使用三元運算式簡寫isset -->
    						<!-- 老師特地使用同樣取名name, id方便傳值?或做相關程式變數取用? -->
							<!--input id=會與資料庫欄位名稱一樣 -->
    					</div>
    					<div class="mb-3 col-6">
    						<label for="school_num" class="form-label">學號</label>
    						<input type="text" class="form-control" name="school_num" id="school_num" value="<?= $school_num ?? ''; ?>">
    					</div>
    					<div class="mb-3 col-6">
    						<label for="birthday" class="form-label">生日</label>
    						<input type="date" class="form-control" name="birthday" id="birthday" value="<?= $birthday ?? ''; ?>">
    					</div>
    					<div class="mb-3 col-6">
    						<label for="uni_id" class="form-label">身分證字號</label>
    						<input type="text" class="form-control" name="uni_id" id="uni_id" value="<?= $uni_id ?? ''; ?>">
    					</div>
    					<div class="mb-3 col-6">
    						<label for="addr" class="form-label">地址</label>
    						<input type="text" class="form-control" name="addr" id="addr" value="<?= $addr ?? ''; ?>">
    					</div>
    					<div class="mb-3 col-6">
    						<label for="parents" class="form-label">家長</label>
    						<input type="text" class="form-control" name="parents" id="parents" value="<?= $parents ?? ''; ?>">
    					</div>
    					<div class="mb-3 col-6">
    						<label for="tel" class="form-label">電話</label>
    						<input type="text" class="form-control" name="tel" id="tel" value="<?= $tel ?? ''; ?>">
    					</div>
    					<div class="mb-3 col-6">
    						<label for="dept" class="form-label">科系</label>
    						<input type="text" class="form-control" name="dept" id="dept" value="<?= $dept ?? ''; ?>">
    					</div>
    					<!-- <div class="mb-3 col-6">
            <label for="graduate_at" class="form-label">畢業學校</label>
            <input type="text" class="form-control" name="graduate_at" id="graduate_at">
          </div> -->
    					<div class="col-6">
    						<label for="schools" class="form-label">畢業學校</label>
							<!-- <label> for="schools"會是對應input的id="schools" -->
    						<select id="schools" class="form-select" name="graduate_at" aria-label="Default select">
    							<!-- <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option> -->
    							<!-- 要在<select>設id="schools" 表單格式建立在api/get_schools.php後傳過來-->
								<!-- 透過jq程式popForm(一連串動作)送出表單後 並會帶入api/get_schools.php option選項(新增:帶資料庫graduate_at的列表 編輯:則帶搭配id的資料庫資訊show上) -->
    						</select>
    					</div>
    					<div class="mb-3 col-6">
    						<label for="status_code" class="form-label">畢業狀態</label>
    						<input type="text" class="form-control" name="status_code" id="status_code" value="<?= $status_code ?? ''; ?>">
    					</div>
						<?php
						if(isset($_GET['id'])){
							echo "<input type='hidden' name='id' value='{$user['id']}'>";
							//這邊還是要理解一下要給誰?
						}

						?>
    					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
    					<button type="submit" class="btn btn-primary">
    						<?= (isset($_GET['id'])) ? '編輯更新' : '確認新增'; ?>
    					</button>
						<!-- 表單要能送出去type=submit, not button喔 -->

    				</form>
    			</div>
    			<div class="modal-footer">
    				<!-- 要送出表單的type:submit type:button不能喔 -->
    			</div>
    		</div>
    	</div>
    </div>