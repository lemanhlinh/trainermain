/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/web/main.js":
/*!**********************************!*\
  !*** ./resources/js/web/main.js ***!
  \**********************************/
/***/ (() => {

eval("$(document).ready(function () {\n  var fixmeTop = $('.menu-head').offset().top;\n  $(window).scroll(function () {\n    var currentScroll = $(window).scrollTop();\n    if (currentScroll >= fixmeTop) {\n      $('.menu-head').css({\n        position: 'fixed',\n        top: '0',\n        left: '0'\n      });\n    } else {\n      $('.menu-head').css({\n        position: 'static'\n      });\n    }\n  });\n  document.getElementById(\"numberInput\").addEventListener(\"input\", function () {\n    // Lấy giá trị nhập vào\n    var inputValue = this.value;\n\n    // Loại bỏ tất cả các ký tự không phải số dương\n    inputValue = inputValue.replace(/[^0-9]/g, \"\");\n\n    // Đặt lại giá trị vào trường nhập liệu\n    this.value = inputValue;\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvd2ViL21haW4uanMiLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsImZpeG1lVG9wIiwib2Zmc2V0IiwidG9wIiwid2luZG93Iiwic2Nyb2xsIiwiY3VycmVudFNjcm9sbCIsInNjcm9sbFRvcCIsImNzcyIsInBvc2l0aW9uIiwibGVmdCIsImdldEVsZW1lbnRCeUlkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImlucHV0VmFsdWUiLCJ2YWx1ZSIsInJlcGxhY2UiXSwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy93ZWIvbWFpbi5qcz84YTcyIl0sInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgIHZhciBmaXhtZVRvcCA9ICQoJy5tZW51LWhlYWQnKS5vZmZzZXQoKS50b3A7XG4gICAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIGN1cnJlbnRTY3JvbGwgPSAkKHdpbmRvdykuc2Nyb2xsVG9wKCk7XG4gICAgICAgIGlmIChjdXJyZW50U2Nyb2xsID49IGZpeG1lVG9wKSB7XG4gICAgICAgICAgICAkKCcubWVudS1oZWFkJykuY3NzKHtcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogJ2ZpeGVkJyxcbiAgICAgICAgICAgICAgICB0b3A6ICcwJyxcbiAgICAgICAgICAgICAgICBsZWZ0OiAnMCdcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnLm1lbnUtaGVhZCcpLmNzcyh7XG4gICAgICAgICAgICAgICAgcG9zaXRpb246ICdzdGF0aWMnXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJudW1iZXJJbnB1dFwiKS5hZGRFdmVudExpc3RlbmVyKFwiaW5wdXRcIiwgZnVuY3Rpb24gKCkge1xuICAgICAgICAvLyBM4bqleSBnacOhIHRy4buLIG5o4bqtcCB2w6BvXG4gICAgICAgIGxldCBpbnB1dFZhbHVlID0gdGhpcy52YWx1ZTtcblxuICAgICAgICAvLyBMb+G6oWkgYuG7jyB04bqldCBj4bqjIGPDoWMga8O9IHThu7Ega2jDtG5nIHBo4bqjaSBz4buRIGTGsMahbmdcbiAgICAgICAgaW5wdXRWYWx1ZSA9IGlucHV0VmFsdWUucmVwbGFjZSgvW14wLTldL2csIFwiXCIpO1xuXG4gICAgICAgIC8vIMSQ4bq3dCBs4bqhaSBnacOhIHRy4buLIHbDoG8gdHLGsOG7nW5nIG5o4bqtcCBsaeG7h3VcbiAgICAgICAgdGhpcy52YWx1ZSA9IGlucHV0VmFsdWU7XG4gICAgfSk7XG59KTtcbiJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLENBQUNDLEtBQUssQ0FBQyxZQUFXO0VBQ3pCLElBQUlDLFFBQVEsR0FBR0gsQ0FBQyxDQUFDLFlBQVksQ0FBQyxDQUFDSSxNQUFNLENBQUMsQ0FBQyxDQUFDQyxHQUFHO0VBQzNDTCxDQUFDLENBQUNNLE1BQU0sQ0FBQyxDQUFDQyxNQUFNLENBQUMsWUFBVztJQUN4QixJQUFJQyxhQUFhLEdBQUdSLENBQUMsQ0FBQ00sTUFBTSxDQUFDLENBQUNHLFNBQVMsQ0FBQyxDQUFDO0lBQ3pDLElBQUlELGFBQWEsSUFBSUwsUUFBUSxFQUFFO01BQzNCSCxDQUFDLENBQUMsWUFBWSxDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUNoQkMsUUFBUSxFQUFFLE9BQU87UUFDakJOLEdBQUcsRUFBRSxHQUFHO1FBQ1JPLElBQUksRUFBRTtNQUNWLENBQUMsQ0FBQztJQUNOLENBQUMsTUFBTTtNQUNIWixDQUFDLENBQUMsWUFBWSxDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUNoQkMsUUFBUSxFQUFFO01BQ2QsQ0FBQyxDQUFDO0lBQ047RUFDSixDQUFDLENBQUM7RUFFRlYsUUFBUSxDQUFDWSxjQUFjLENBQUMsYUFBYSxDQUFDLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxZQUFZO0lBQ3pFO0lBQ0EsSUFBSUMsVUFBVSxHQUFHLElBQUksQ0FBQ0MsS0FBSzs7SUFFM0I7SUFDQUQsVUFBVSxHQUFHQSxVQUFVLENBQUNFLE9BQU8sQ0FBQyxTQUFTLEVBQUUsRUFBRSxDQUFDOztJQUU5QztJQUNBLElBQUksQ0FBQ0QsS0FBSyxHQUFHRCxVQUFVO0VBQzNCLENBQUMsQ0FBQztBQUNOLENBQUMsQ0FBQyJ9\n//# sourceURL=webpack-internal:///./resources/js/web/main.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/web/main.js"]();
/******/ 	
/******/ })()
;