﻿(function (n, t) { var f = t.$jhtmlarea = {}, i = f.browser = {}, r, u; (function () { i.msie = !1, i.mozilla = !1, i.safari = !1, i.version = 0, navigator.userAgent.match(/MSIE ([0-9]+)\./) ? (i.msie = !0, i.version = parseFloat(RegExp.$1)) : navigator.userAgent.match(/Trident\/([0-9]+)\./) && (i.msie = !0, i.version = RegExp.$1, navigator.userAgent.match(/rv:([0-9]+)\./) && (i.version = parseFloat(RegExp.$1))), navigator.userAgent.match(/Mozilla\/([0-9]+)\./) && (i.mozilla = !0, i.version === 0 && (i.version = parseFloat(RegExp.$1))), navigator.userAgent.match(/Safari ([0-9]+)\./) && (i.safari = !0, i.version = RegExp.$1, navigator.userAgent.match(/Version\/([0-9]+)\./) && i.version === 0 && (i.version = parseFloat(RegExp.$1))) })(), n.fn.htmlarea = function (n) { var i, t, u, f; if (n && typeof n == "string") { for (i = [], t = 1; t < arguments.length; t++) i.push(arguments[t]); if (u = r(this[0]), f = u[n], f) return f.apply(u, i) } return this.each(function () { r(this, n) }) }, r = t.jHtmlArea = function (n, t) { return n.jquery ? r(n[0]) : n.jhtmlareaObject ? n.jhtmlareaObject : new r.fn.init(n, t) }, r.fn = r.prototype = { jhtmlarea: "0.8", init: function (t, i) { var e, o, c; if (t.nodeName.toLowerCase() === "textarea") { e = n.extend({}, r.defaultOptions, i), t.jhtmlareaObject = this; var f = this.textarea = n(t), s = this.container = n("<div/>").addClass("jHtmlArea").width(f.width()).insertAfter(f), h = this.toolbar = n("<div/>").addClass("ToolBar").appendTo(s); u.initToolBar.call(this, e), o = this.iframe = n("<iframe/>").height(f.height()), o.width(f.width()), c = this.htmlarea = n("<div/>").append(o), s.append(c).append(f.hide()), u.initEditor.call(this, e), u.attachEditorEvents.call(this), o.height(o.height() - h.height()), h.width(f.width()), e.loaded && e.loaded.call(this) } }, dispose: function () { this.textarea.show().insertAfter(this.container), this.container.remove(), this.textarea[0].jhtmlareaObject = null }, execCommand: function (n, t, i) { this.iframe[0].contentWindow.focus(), this.editor.execCommand(n, t || !1, i || null), this.updateTextArea() }, ec: function (n, t, i) { this.execCommand(n, t, i) }, queryCommandValue: function (n) { return this.iframe[0].contentWindow.focus(), this.editor.queryCommandValue(n) }, qc: function (n) { return this.queryCommandValue(n) }, getSelectedHTML: function () { if (i.msie) return this.getRange().htmlText; var t = this.getRange().cloneContents(); return n("<p/>").append(n(t)).html() }, getSelection: function () { return i.msie === !0 && i.version < 11 ? this.editor.selection : this.iframe[0].contentDocument.defaultView.getSelection() }, getRange: function () { var n = this.getSelection(); return n ? n.getRangeAt ? n.getRangeAt(0) : n.createRange() : null }, html: function (n) { if (n) this.textarea.val(n), this.updateHtmlArea(); else return this.toHtmlString() }, pasteHTML: function (t) { this.iframe[0].contentWindow.focus(); var r = this.getRange(); i.msie ? r.pasteHTML(t) : i.mozilla ? (r.deleteContents(), r.insertNode(n(t.indexOf("<") != 0 ? n("<span/>").append(t) : t)[0])) : (r.deleteContents(), r.insertNode(n(this.iframe[0].contentWindow.document.createElement("span")).append(n(t.indexOf("<") != 0 ? "<span>" + t + "<\/span>" : t))[0])), r.collapse(!1), r.select() }, cut: function () { this.ec("cut") }, copy: function () { this.ec("copy") }, paste: function () { this.ec("paste") }, bold: function () { this.ec("bold") }, italic: function () { this.ec("italic") }, underline: function () { this.ec("underline") }, strikeThrough: function () { this.ec("strikethrough") }, image: function (n) { i.msie !== !0 || n ? this.ec("insertImage", !1, n || prompt("Image URL:", "http://")) : this.ec("insertImage", !0) }, removeFormat: function () { this.ec("removeFormat", !1, []), this.unlink() }, link: function () { i.msie === !0 ? this.ec("createLink", !0) : this.ec("createLink", !1, prompt("Link URL:", "http://")) }, unlink: function () { this.ec("unlink", !1, []) }, orderedList: function () { this.ec("insertorderedlist") }, unorderedList: function () { this.ec("insertunorderedlist") }, superscript: function () { this.ec("superscript") }, subscript: function () { this.ec("subscript") }, p: function () { this.formatBlock("<p>") }, h1: function () { this.heading(1) }, h2: function () { this.heading(2) }, h3: function () { this.heading(3) }, h4: function () { this.heading(4) }, h5: function () { this.heading(5) }, h6: function () { this.heading(6) }, heading: function (n) { this.formatBlock(i.msie === !0 ? "Heading " + n : "h" + n) }, indent: function () { this.ec("indent") }, outdent: function () { this.ec("outdent") }, insertHorizontalRule: function () { this.ec("insertHorizontalRule", !1, "ht") }, justifyLeft: function () { this.ec("justifyLeft") }, justifyCenter: function () { this.ec("justifyCenter") }, justifyRight: function () { this.ec("justifyRight") }, increaseFontSize: function () { i.msie === !0 ? this.ec("fontSize", !1, this.qc("fontSize") + 1) : i.safari ? this.getRange().surroundContents(n(this.iframe[0].contentWindow.document.createElement("span")).css("font-size", "larger")[0]) : this.ec("increaseFontSize", !1, "big") }, decreaseFontSize: function () { i.msie === !0 ? this.ec("fontSize", !1, this.qc("fontSize") - 1) : i.safari ? this.getRange().surroundContents(n(this.iframe[0].contentWindow.document.createElement("span")).css("font-size", "smaller")[0]) : this.ec("decreaseFontSize", !1, "small") }, forecolor: function (n) { this.ec("foreColor", !1, n !== undefined ? n : prompt("Enter HTML Color:", "#")) }, formatBlock: function (n) { this.ec("formatblock", !1, n || null) }, showHTMLView: function () { this.updateTextArea(), this.textarea.show(), this.htmlarea.hide(), n("ul li:not(li:has(a.html))", this.toolbar).hide(), n("ul:not(:has(:visible))", this.toolbar).hide(), n("ul li a.html", this.toolbar).addClass("highlighted") }, hideHTMLView: function () { this.updateHtmlArea(), this.textarea.hide(), this.htmlarea.show(), n("ul", this.toolbar).show(), n("ul li", this.toolbar).show().find("a.html").removeClass("highlighted") }, toggleHTMLView: function () { this.textarea.is(":hidden") ? this.showHTMLView() : this.hideHTMLView() }, toHtmlString: function () { return this.editor.body.innerHTML }, toString: function () { return this.editor.body.innerText }, updateTextArea: function () { this.textarea.val(this.toHtmlString()) }, updateHtmlArea: function () { this.editor.body.innerHTML = this.textarea.val() } }, r.fn.init.prototype = r.fn, r.defaultOptions = { toolbar: [["html"], ["bold", "italic", "underline", "strikethrough", "|", "subscript", "superscript"], ["increasefontsize", "decreasefontsize"], ["orderedlist", "unorderedlist"], ["indent", "outdent"], ["justifyleft", "justifycenter", "justifyright"], ["link", "unlink", "image", "horizontalrule"], ["p", "h1", "h2", "h3", "h4", "h5", "h6"], ["cut", "copy", "paste"]], css: null, toolbarText: { bold: "Bold", italic: "Italic", underline: "Underline", strikethrough: "Strike-Through", cut: "Cut", copy: "Copy", paste: "Paste", h1: "Heading 1", h2: "Heading 2", h3: "Heading 3", h4: "Heading 4", h5: "Heading 5", h6: "Heading 6", p: "Paragraph", indent: "Indent", outdent: "Outdent", horizontalrule: "Insert Horizontal Rule", justifyleft: "Left Justify", justifycenter: "Center Justify", justifyright: "Right Justify", increasefontsize: "Increase Font Size", decreasefontsize: "Decrease Font Size", forecolor: "Text Color", link: "Insert Link", unlink: "Remove Link", image: "Insert Image", orderedlist: "Insert Ordered List", unorderedlist: "Insert Unordered List", subscript: "Subscript", superscript: "Superscript", html: "Show/Hide HTML Source View" } }, u = { toolbarButtons: { strikethrough: "strikeThrough", orderedlist: "orderedList", unorderedlist: "unorderedList", horizontalrule: "insertHorizontalRule", justifyleft: "justifyLeft", justifycenter: "justifyCenter", justifyright: "justifyRight", increasefontsize: "increaseFontSize", decreasefontsize: "decreaseFontSize", html: function () { this.toggleHTMLView() } }, initEditor: function (n) { var t = this.editor = this.iframe[0].contentWindow.document, i; t.designMode = "on", t.open(), t.write(this.textarea.val()), t.close(), n.css && (i = t.createElement("link"), i.rel = "stylesheet", i.type = "text/css", i.href = n.css, t.getElementsByTagName("head")[0].appendChild(i)) }, initToolBar: function (t) { function e(i) { for (var s = n("<ul/>").appendTo(r.toolbar), e, h, c, o = 0; o < i.length; o++) e = i[o], (typeof e).toLowerCase() === "string" ? e === "|" ? s.append(n('<li class="separator"/>')) : (h = function (n) { var t = u.toolbarButtons[n] || n; return (typeof t).toLowerCase() === "function" ? function (n) { t.call(this, n) } : function () { this[t](), this.editor.body.focus() } }(e.toLowerCase()), c = t.toolbarText[e.toLowerCase()], s.append(f(e.toLowerCase(), c || e, h))) : s.append(f(e.css, e.text, e.action)) } var r = this, f = function (t, i, u) { return n("<li/>").append(n("<a href='javascript:void(0);'/>").addClass(t).attr("title", i).click(function () { u.call(r, n(this)) })) }, i; if (t.toolbar.length !== 0 && u.isArray(t.toolbar[0])) for (i = 0; i < t.toolbar.length; i++) e(t.toolbar[i]); else e(t.toolbar) }, attachEditorEvents: function () { var i = this, u = function () { i.updateHtmlArea() }, r, f; this.textarea.click(u).keyup(u).keydown(u).mousedown(u).blur(u), r = function () { i.updateTextArea() }, n(this.editor.body).click(r).keyup(r).keydown(r).mousedown(r).blur(r), n("form").submit(function () { i.toggleHTMLView(), i.toggleHTMLView() }), t.__doPostBack && (f = __doPostBack, t.__doPostBack = function () { return i && i.toggleHTMLView && (i.toggleHTMLView(), i.toggleHTMLView()), f.apply(t, arguments) }) }, isArray: function (n) { return n && typeof n == "object" && typeof n.length == "number" && typeof n.splice == "function" && !n.propertyIsEnumerable("length") } } })(jQuery, window);
//@ sourceMappingURL=jHtmlArea-0.8.min.js.map