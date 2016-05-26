//初始化类的函数，参数：当前类，初始化方法,父类，调用父类（如果父类还没初始化）
//initCalssIfNotYet(GDAbstractView,function(prototype){
////
//},GDObject,function(){
////
//});
function createNewObject(thisObject,thisClass, superClass, initMethod) {
	if (thisClass.prototype.hasInit == null){
		if (superClass != null) {
			if (superClass.prototype.hasInit == null) {
				new superClass();
			}
			alert("1");
			for (var pro in superClass.prototype) {
				thisClass.prototype[pro] = superClass.prototype[pro];
			}
		}
		initMethod(thisClass.prototype);
		
		//定义一些固定的类变量
		thisClass.prototype.superClass=superClass;
		
		thisClass.prototype.hasInit == true;
	}
	//定义一些固定的类变量
	thisObject.realClass=thisClass;
	
			alert("2");
	//调用实例的构造方法
	var base;
	if(superClass!=null){
		base=superClass.prototype.createNewInstance;
	}
	thisObject.createNewInstance(base);
}

function GDObject() {
	//为了便于debug，先注明类名
	this.className="GDObject";
	//在这个函数中定义方法，类变量
	createNewObject(this,GDObject,null,function(prototype) {
		//构造对象的方法是必须的，在这个函数中定义实例变量
		prototype.createNewInstance=function(){
			
		};
		prototype.say = function(str) {
			alert(str);
		};
	});
}

function GDAbstractView(tagName, width, height, style) {
	this.className="GDAbstractView";
	createNewObject(this,GDAbstractView, GDObject, function(prototype) {
		prototype.createNewInstance=function(base,tagName, width, height, style){
			alert("GDAbstractView   this="+this.className);
			//调用父类的构造方法
			//base.call(this,argument1,argument2,argument3);
			//base.apply(this,arguments);
			base.call(this);
			//初始化当前对象
			this.dom = document.createElement(tagName);
			this.superView=null;
			var note = document.createTextNode("fwrefefew");
			this.dom.appendChild(note);
		}
		//添加到HTML文档上，参数是上级元素的id
		prototype.addTo=function(id){
			var superView=document.getElementById(id);
			superView.appendChild(this.dom);
			this.superView=superView;
		}
		//添加下级元素，参数是下级元素的对象
		prototype.add=function(subView){
			this.dom.appendChild(subView.dom);
			subView.superView=this.dom;
		}
		//从上级元素上删除本元素
		prototype.remove=function(){
			this.superView.removeChild(this.dom);
			this.superView=null;
		}
	});
}

function GDView(width, height, style) {
	this.className="GDView";
	createNewObject(this,GDView, GDAbstractView, function(prototype) {
		prototype.createNewInstance=function(base){
			alert(base);
			base.call(this,"div",100,100,null);
		}
//		prototype.say = function(str) {
//			alert("GDVIEW:"+str);
//		};
	});
}