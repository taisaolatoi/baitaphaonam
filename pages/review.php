<div class="box_review">
    <h2 class="title_review">Sản phẩm A</h2>
    <div class="box_review_flex">
        <div class="box_score">
            <p class="title_score">0/5</p>
            <div class="">

            </div>
            <p>
                <strong></strong> đánh giá và nhận xét
            </p>
        </div>
        <div class="box_start">
            <div class="rating_level">
                <div class="start_count">
                    <span>5</span>
                    <i class="fas fa-star" style="color: #f59e0b; margin-left: 5px;"></i>
                </div>
                <span> Đánh giá</span>
            </div>

            <div class="rating_level">
                <div class="start_count">
                    <span>4</span>
                    <i class="fas fa-star" style="color: #f59e0b; margin-left: 5px;"></i>
                </div>
                <span> Đánh giá</span>
            </div>

            <div class="rating_level">
                <div class="start_count">
                    <span>3</span>
                    <i class="fas fa-star" style="color: #f59e0b; margin-left: 5px;"></i>
                </div>
                <span> Đánh giá</span>
            </div>

            <div class="rating_level">
                <div class="start_count">
                    <span>2</span>
                    <i class="fas fa-star" style="color: #f59e0b; margin-left: 5px;"></i>
                </div>
                <span> Đánh giá</span>
            </div>

            <div class="rating_level">
                <div class="start_count">
                    <span>1</span>
                    <i class="fas fa-star" style="color: #f59e0b; margin-left: 5px;"></i>
                </div>
                <span> Đánh giá</span>
            </div>
        </div>
    </div>

    <p style="display: flex; justify-content: center; margin: 10px 0;">Bạn đánh giá sao sản phẩm này?</p>
    <div class="btn-regis">
        <button onclick="openModal()">Đánh giá ngay</button>
    </div>

    <hr />







    <div style="display : none;" class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Đánh giá sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="uploadImage" class="form-label">Upload ảnh:</label>
                        <input style="padding: 10px 5px; border: 1px solid #ccc" type="file" class="form-control"
                            id="uploadImage">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Nhận xét:</label>
                        <textarea style="width: 100%" class="form-control" id="comment"
                            placeholder="Nhập nhận xét của bạn"></textarea>
                    </div>
                    <p class="mb-3">Bạn cảm thấy sản phẩm như thế nào?</p>
                    <div style="flex-direction: row; margin: 0 auto;" class="box_score d-flex justify-content-center">
                        <?php for ($star = 1; $star <= 5; $star++) { ?>
                            <div class="icon" onclick="handleRating(<?php echo $star; ?>)">
                                <i class="fas fa-star"></i>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()"
                        data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="handleSubmit()">Gửi</button>
                </div>
            </div>
        </div>
    </div>


    <script>

        let rating = 0;


        function handleRating(star) {
            rating = star;
            const icons = document.querySelectorAll('.box_score .icon i');
            for (let i = 0; i < icons.length; i++) {
                if (i < star) {
                    icons[i].style.color = '#f59e0b';
                } else {
                    icons[i].style.color = '';
                }
            }
        }


        function handleSubmit() {
            const uploadImage = document.getElementById('uploadImage').files[0];
            const comment = document.getElementById('comment').value;

            const data = new FormData();
            data.append('image', uploadImage);
            data.append('comment', comment);
            data.append('rating', ratings);

            fetch(window.location.href, {
                method: 'POST',
                body: data
            })
                .then(response => response.json())
                .then(result => {
                    // Xử lý kết quả từ server
                    console.log(result);
                })
                .catch(error => {
                    // Xử lý lỗi (nếu có)
                    console.error(error);
                });
        }




        // Function to open the modal
        function openModal() {
            const modal = document.getElementById('reviewModal');
            modal.style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById('reviewModal');
            modal.style.display = 'none';
        }

        // Event listener to open the modal when the button is clicked
        document.querySelector('.btn-regis button').addEventListener('click', openModal);

        // Event listener to close the modal when the close button is clicked
        document.querySelectorAll('.btn-close').forEach((btn) => {
            btn.addEventListener('click', closeModal);
        });

        // Event listener to close the modal when the user clicks outside the modal
        window.addEventListener('click', (event) => {
            const modal = document.getElementById('reviewModal');
            if (event.target === modal) {
                closeModal();
            }
        });
    </script>




    <style>
        .box_review {
            border-radius: 10px;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.1), 0 2px 6px 2px rgba(60, 64, 67, 0.15);
            padding: 0.5rem !important;
            width: 1100px;
            margin-left: 10%;
            margin-bottom: 50px;
        }

        .box_review h2 {
            padding: 5px;
            margin-left: 10px;
            font-size: 1rem;
        }

        .box_review_flex {
            height: 160px;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
        }

        .box_score {
            width: 40%;
            border-left: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .title_score {
            font-size: 1.5rem;
            font-weight: 500;
            line-height: 1.125;
        }

        .box_score .icon {
            align-items: center;
            display: inline-flex;
            justify-content: center;
            height: 1.5rem;
            width: 1.5rem;
        }

        .box_start {
            width: 60%;
            flex-direction: column;
            display: flex;
            justify-content: space-evenly;
            padding: 20px;
        }

        .rating_level {
            display: flex;
            gap: 10px;
        }

        .box_review .btn-regis {
            width: max-content;
            margin: 0 auto;
        }

        .box_review hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .box_cmt_review {
            display: flex;
            margin-bottom: 20px;
        }

        .box_cmt_review .admin_container {
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
            border-radius: 10px;
            padding: 10px;
        }

        .box_cmt_review p {
            font-size: 13px;
            line-height: 1.6;
        }

        .box_review .box_name {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .box_cmt_review .product_rating p {
            margin: 0;
            font-size: 12px;
            font-weight: 700;
            line-height: 2;
            text-transform: capitalize;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-dialog {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            opacity: 1;
            transition: opacity 0.3s;
            margin: 0 auto;
            width: 600px;
            padding: 20px;
            margin-top: 10%;
        }

        .modal.show .modal-dialog {
            opacity: 1;
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        .modal-body textarea {
            /* max-width: 100%; */
            height: auto;
            min-height: 32px;
            line-height: 1.5714285714285714;
            vertical-align: bottom;
            transition: all 0.3s, height 0s;
            resize: vertical;
            width: 100%;
            box-sizing: border-box;
            padding: 4px 11px;
            color: rgba(0, 0, 0, 0.88);
            font-size: 14px;
            line-height: 1.5714285714285714;
            list-style: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            position: relative;
            display: inline-block;
            width: 100%;
            min-width: 0;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .modal-footer {
            display: flex;
            justify-content: end;
            gap: 10px
        }

        .modal-footer button {
            border-radius: 5px;
            padding: 10px 20px;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .modal-footer .btn-primary {
            background-color: #f59e0b;
            border-color: #f59e0b;
            color: #fff;
        }

        .modal-footer button:hover {
            opacity: 0.8;
        }



        .btn-regis button {
            background-color: #f59e0b;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: opacity 0.3s;
        }

        .btn-regis button:hover {
            opacity: 0.8;
        }

        .btn-regis button.hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>