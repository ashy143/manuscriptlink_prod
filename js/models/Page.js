function Page(){
    this.pageNum = -1;
    this.pageSide = "x";
    this.pageId = -1;
    this.image = "blankpage.jpg";
    this.abbrShelf = "";
    this.author = '';
    this.text = '';
    this.genre= '';
    this.origin='';
    this.date='';
    this.writing_sup='';
    this.height='';
    this.width='';
    this.no_of_col='';
    this.no_of_lines='';
    this.contents='';
    
    this.getPageNum = function getPageNum(){
        return this.pageNum;
    };
    this.getPageId = function getPageId(){
        return this.pageId;
    };
    this.getPageSide = function getPageSide(){
        return this.pageSide;
    };
    this.getImage = function getImage(){
        return this.image;
    };
    this.getAbbrShelf = function getAbbrShelf(){
        return this.abbrShelf;
    };
}