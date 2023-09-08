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

eval("$(document).ready(function () {\n  var fixmeTop = $('.menu-head').offset().top;\n  $(window).scroll(function () {\n    var currentScroll = $(window).scrollTop();\n    if (currentScroll >= fixmeTop) {\n      $('.menu-head').css({\n        position: 'fixed',\n        top: '0',\n        left: '0'\n      });\n    } else {\n      $('.menu-head').css({\n        position: 'static'\n      });\n    }\n  });\n  document.getElementById(\"numberInput\").addEventListener(\"input\", function () {\n    // Lấy giá trị nhập vào\n    var inputValue = this.value;\n\n    // Loại bỏ tất cả các ký tự không phải số dương\n    inputValue = inputValue.replace(/[^0-9]/g, \"\");\n\n    // Đặt lại giá trị vào trường nhập liệu\n    this.value = inputValue;\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsImZpeG1lVG9wIiwib2Zmc2V0IiwidG9wIiwid2luZG93Iiwic2Nyb2xsIiwiY3VycmVudFNjcm9sbCIsInNjcm9sbFRvcCIsImNzcyIsInBvc2l0aW9uIiwibGVmdCIsImdldEVsZW1lbnRCeUlkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImlucHV0VmFsdWUiLCJ2YWx1ZSIsInJlcGxhY2UiXSwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL3dlYi9tYWluLmpzPzhhNzIiXSwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgdmFyIGZpeG1lVG9wID0gJCgnLm1lbnUtaGVhZCcpLm9mZnNldCgpLnRvcDtcbiAgICAkKHdpbmRvdykuc2Nyb2xsKGZ1bmN0aW9uKCkge1xuICAgICAgICB2YXIgY3VycmVudFNjcm9sbCA9ICQod2luZG93KS5zY3JvbGxUb3AoKTtcbiAgICAgICAgaWYgKGN1cnJlbnRTY3JvbGwgPj0gZml4bWVUb3ApIHtcbiAgICAgICAgICAgICQoJy5tZW51LWhlYWQnKS5jc3Moe1xuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiAnZml4ZWQnLFxuICAgICAgICAgICAgICAgIHRvcDogJzAnLFxuICAgICAgICAgICAgICAgIGxlZnQ6ICcwJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKCcubWVudS1oZWFkJykuY3NzKHtcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogJ3N0YXRpYydcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm51bWJlcklucHV0XCIpLmFkZEV2ZW50TGlzdGVuZXIoXCJpbnB1dFwiLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIC8vIEzhuqV5IGdpw6EgdHLhu4sgbmjhuq1wIHbDoG9cbiAgICAgICAgbGV0IGlucHV0VmFsdWUgPSB0aGlzLnZhbHVlO1xuXG4gICAgICAgIC8vIExv4bqhaSBi4buPIHThuqV0IGPhuqMgY8OhYyBrw70gdOG7sSBraMO0bmcgcGjhuqNpIHPhu5EgZMawxqFuZ1xuICAgICAgICBpbnB1dFZhbHVlID0gaW5wdXRWYWx1ZS5yZXBsYWNlKC9bXjAtOV0vZywgXCJcIik7XG5cbiAgICAgICAgLy8gxJDhurd0IGzhuqFpIGdpw6EgdHLhu4sgdsOgbyB0csaw4budbmcgbmjhuq1wIGxp4buHdVxuICAgICAgICB0aGlzLnZhbHVlID0gaW5wdXRWYWx1ZTtcbiAgICB9KTtcbn0pO1xuIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFlBQVc7RUFDekIsSUFBSUMsUUFBUSxHQUFHSCxDQUFDLENBQUMsWUFBWSxDQUFDLENBQUNJLE1BQU0sQ0FBQyxDQUFDLENBQUNDLEdBQUc7RUFDM0NMLENBQUMsQ0FBQ00sTUFBTSxDQUFDLENBQUNDLE1BQU0sQ0FBQyxZQUFXO0lBQ3hCLElBQUlDLGFBQWEsR0FBR1IsQ0FBQyxDQUFDTSxNQUFNLENBQUMsQ0FBQ0csU0FBUyxDQUFDLENBQUM7SUFDekMsSUFBSUQsYUFBYSxJQUFJTCxRQUFRLEVBQUU7TUFDM0JILENBQUMsQ0FBQyxZQUFZLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQ2hCQyxRQUFRLEVBQUUsT0FBTztRQUNqQk4sR0FBRyxFQUFFLEdBQUc7UUFDUk8sSUFBSSxFQUFFO01BQ1YsQ0FBQyxDQUFDO0lBQ04sQ0FBQyxNQUFNO01BQ0haLENBQUMsQ0FBQyxZQUFZLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQ2hCQyxRQUFRLEVBQUU7TUFDZCxDQUFDLENBQUM7SUFDTjtFQUNKLENBQUMsQ0FBQztFQUVGVixRQUFRLENBQUNZLGNBQWMsQ0FBQyxhQUFhLENBQUMsQ0FBQ0MsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVk7SUFDekU7SUFDQSxJQUFJQyxVQUFVLEdBQUcsSUFBSSxDQUFDQyxLQUFLOztJQUUzQjtJQUNBRCxVQUFVLEdBQUdBLFVBQVUsQ0FBQ0UsT0FBTyxDQUFDLFNBQVMsRUFBRSxFQUFFLENBQUM7O0lBRTlDO0lBQ0EsSUFBSSxDQUFDRCxLQUFLLEdBQUdELFVBQVU7RUFDM0IsQ0FBQyxDQUFDO0FBQ04sQ0FBQyxDQUFDIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3dlYi9tYWluLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/web/main.js\n");

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