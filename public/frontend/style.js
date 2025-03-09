
		    //  $(document).ready(function() {
		    //     $('.addWishlist').on('click', function(){
		    //           var id = $(this).data('id');
		    //           if(id) {
		    //              $.ajax({
		    //                  url: "{{ url('user/add/wish-list/') }}/"+id,
		    //                  type:"GET",
		    //                  dataType:"json",
		    //                  success:function(data) {
		    //                     if (data.success) {
		    //                         toastr.success(data.success)
		    //                         $.ajax({
		    //                             type: "GET",
		    //                             url: "user/count/wishlist",
		    //                             dataType: 'json',
		    //                             success: function (data) {
		    //                                   $('.wishlist-count').text(data);
		    //                             },
		    //                          });

		    //                          $.ajax({
		    //                            type: "GET",
		    //                            url: "user/show/wishlist",
		    //                            success: function (data) {
		    //                               $('.wish_list_popup').html(data)
		    //                            },
		    //                         });
		    //                     }else{
		    //                         toastr.error(data.error)
		    //                     }

		    //                  },
		    //                  error:function(data){
		    //                  	toastr.error('<h3>Please Login Your Account</h3>');
		    //                  }
		    //              });
		    //          } else {

		    //          }
		    //      });
		    //  });

			// $('.addCard').on('submit', function(e) {
			//     e.preventDefault();
			//     $('.loading').removeClass('d-none');
			//     var url = $(this).attr('action');
			//     var request = $(this).serialize();
			//     $.ajax({
			//         url: url,
			//         type: 'post',
			//         data: new FormData(this),
			//         contentType: false,
			//         cache: false,
			//         processData: false,
			// 			success:function(data){
			// 				toastr.options = {
			// 				  "closeButton": true,
			// 				  "progressBar": true,
			// 				}
			// 				toastr.success(data);

			// 				 $.ajax({
			// 				   type: "GET",
			// 				   url: "cart/show",
			// 				   success: function (data) {
			// 				      $('.cart_list_popup').html(data)
			// 				   },
			// 				});

			// 				 $.ajax({
			// 				   type: "GET",
			// 				   url: "cart/count",
			// 				   success: function (data) {
			// 				      $('.cart-count').text(data)
			// 				   },
			// 				});
			// 			},
			// 		});
			// 	});

			// $(document).ready(function wishlist($)  {
			//     $.ajax({
			//       type: "GET",
			//       url: "user/count/wishlist",
			//       dataType: 'json',
			//       success: function (data) {
			//           $('.wishlist-count').text(data)
			//       },
			//    	});
			// });

			// $(document).ready(function show(){
			// 	 $.ajax({
			// 	   type: "GET",
			// 	   url: "user/show/wishlist",
			// 	   success: function (data) {
			// 	      $('.wish_list_popup').html(data)
			// 	   },
			// 	});
			// })



			// $(document).ready(function(){
			// 	 $.ajax({
			// 	   type: "GET",
			// 	   url: "cart/show",
			// 	   success: function (data) {
			// 	      $('.cart_list_popup').html(data)
			// 	   },
			// 	});
			// })

