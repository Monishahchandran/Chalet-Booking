//
//  WeekdaysView.swift
//  myCalender2
//
//  Created by Muskan on 10/22/17.
//  Copyright © 2017 akhil. All rights reserved.
//WeekdaysViewNew

import UIKit

class WeekdaysViewNew: UIView {
    
    override init(frame: CGRect) {
        super.init(frame: frame)
        //self.backgroundColor=UIColor.clear
        self.backgroundColor = #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1)
        setupViews()
    }
    
    func setupViews() {
        addSubview(myStackView)
        myStackView.topAnchor.constraint(equalTo: topAnchor).isActive=true
        myStackView.leftAnchor.constraint(equalTo: leftAnchor).isActive=true
        myStackView.rightAnchor.constraint(equalTo: rightAnchor).isActive=true
        myStackView.bottomAnchor.constraint(equalTo: bottomAnchor).isActive=true
        
        let daysArr = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
        for i in 0..<7 {
            let lbl=UILabel()
            lbl.text=daysArr[i]
            lbl.textAlignment = .center
            lbl.textColor = .white
            lbl.font = UIFont(name: "Roboto-Bold", size: 16.0)
            myStackView.addArrangedSubview(lbl)
        }
    }
    
    let myStackView: UIStackView = {
        let stackView=UIStackView()
        stackView.distribution = .fillEqually
        stackView.translatesAutoresizingMaskIntoConstraints=false
        return stackView
    }()
    
    required init?(coder aDecoder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
}
