//
//  ColumnFlowLayout.swift

//
//  Created by Visakh on 07/05/21.
//  Copyright © 2021 Srishti. All rights reserved.
//

import UIKit
class ColumnFlowLayout: UICollectionViewFlowLayout {
    let cellsPerRow: Int
    let cellHeight: CGFloat
    let cellWidth: CGFloat

    override var itemSize: CGSize {
        get {
            guard let collectionView = collectionView else { return super.itemSize }
            let marginsAndInsets = sectionInset.left + sectionInset.right + minimumInteritemSpacing * CGFloat(cellsPerRow - 1)
            let itemWidth = ((collectionView.bounds.size.width - marginsAndInsets) / CGFloat(cellsPerRow)).rounded(.down)
            return CGSize(width: cellWidth, height: cellHeight)
        }
        set {
            super.itemSize = newValue
        }
    }
    
    init(cellsPerRow: Int, minimumInteritemSpacing: CGFloat = 0, minimumLineSpacing: CGFloat = 0, sectionInset: UIEdgeInsets = .zero, cellHeight: CGFloat,cellWidth:CGFloat,scrollDirec : UICollectionView.ScrollDirection){
        self.cellsPerRow = cellsPerRow
        self.cellHeight = cellHeight
        self.cellWidth = cellWidth

        super.init()
        self.minimumInteritemSpacing = minimumInteritemSpacing
        self.minimumLineSpacing = minimumLineSpacing
        self.sectionInset = sectionInset
        self.scrollDirection = scrollDirec
        //self.scrollDirection = .horizontal
        
    }
    
    required init?(coder aDecoder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
    override func invalidationContext(forBoundsChange newBounds: CGRect) -> UICollectionViewLayoutInvalidationContext {
        let context = super.invalidationContext(forBoundsChange: newBounds) as! UICollectionViewFlowLayoutInvalidationContext
        context.invalidateFlowLayoutDelegateMetrics = newBounds != collectionView?.bounds
        return context
    }
}

