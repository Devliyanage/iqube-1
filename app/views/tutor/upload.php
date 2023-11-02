<?php $this->view('inc/header',$data); ?>
<link rel="stylesheet" href="<?php echo URLROOT;?>/assets/css/tutor/upload.css">
<body>
    <div class="container">
        <!-- start of sidebar -->
        <?php $this->view('inc/sidebar'); ?>
        <!-- end of sidebar -->

        <!-- start of main part -->
        <div id="main" class="main">
            <!-- start of navbar -->
            <?php $this->view('inc/navbar',$data); ?>

            <!-- end of navbar -->

            <!-- start of content -->
            <div class="formbold-main-wrapper">
                <!-- Author: FormBold Team -->
                <!-- Learn More: https://formbold.com -->
                <div class="formbold-form-wrapper">
                    <div class="uploadname">
                        <label>
                            Upload Course Material
                        </label>
                    </div>
                  <form  action="<?php echo URLROOT;?>/Tutor/upload" method = "post" >
                   
                    <div class="formbold-mb-5">
                        <label for="email" class="formbold-form-label">
                          Course chapter
                        </label>
                        <input
                          type="text"
                          name="chapter"
                          id="chapter"
                          placeholder="Course chapter"
                          class="formbold-form-input"
                        />
                      </div>
                      <div class="formbold-mb-5">
                        <label for="email" class="formbold-form-label">
                          Material Type
                        </label>
                        <select name="type" id="">
                            
                           
                            <option>Video</option>
                            <option>Model Papers</option>

                        </select>
                      </div>
                      <div class="formbold-mb-5">
                        <label for="email" class="formbold-form-label">
                          Price
                        </label>
                        <input
                          type="text"
                          name="price"
                          id="price"
                          placeholder="Price in LKR"
                          class="formbold-form-input"
                        />
                      </div>
                      
                      <div class="formbold-mb-5">
                        <label for="email" class="formbold-form-label">
                          Course description:
                        </label>
                        <input
                          type="textarea"
                          name="description"
                          id="description"
                          placeholder="Describe about the course material"
                          class="description-input"
                        />
                      </div>
              
                    <div class="mb-6 pt-4">
                      <label class="formbold-form-label formbold-form-label-2">
                        Upload File
                      </label>
              
                      <div class="formbold-mb-5 formbold-file-input">
                        <input type="file" name="file" id="file" />
                        <label for="file">
                          <div>
                            <span class="formbold-drop-file"> Drop files here </span>
                            <span class="formbold-or"> Or </span>
                            <span class="formbold-browse"> Browse </span>
                          </div>
                        </label>
                      </div>
              
                    
              
                      <div class="formbold-file-list formbold-mb-5">
                        <div class="formbold-file-item">
                          <span class="formbold-file-name"> Mechanics.mp4 </span>
                          <button>
                            <svg
                              width="10"
                              height="10"
                              viewBox="0 0 10 10"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                                fill="currentColor"
                              />
                              <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                                fill="currentColor"
                              />
                            </svg>
                          </button>
                        </div>
                        <div class="formbold-progress-bar">
                          <div class="formbold-progress"></div>
                        </div>
                      </div>
                    </div>
              
                    <div>
                      <button class="formbold-btn w-full" name="submit" value="submit">Submit</button>
                    </div>
                  </form>
                </div>
              </div>

    <!-- ================End of content ================= -->

        </div>
    </div>

    <?php $this->view('inc/footer'); ?>



