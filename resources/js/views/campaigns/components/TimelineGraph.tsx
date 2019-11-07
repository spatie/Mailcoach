import React, { useState } from 'react';
import { map } from 'lodash';

type DataSet = Array<[number, string]>;

type Props = {
    data: Array<[DataSet, string]>;
};

export default function LineChart({ data }: Props) {
    if (!Object.keys(data).length) {
        return null;
    }

    const [visibleGraphs, setVisibleGraphs] = useState<Array<string>>(map(data, ([, label]) => label));

    function toggleVisibility(label: string) {
        let graphs = [...visibleGraphs];

        graphs.includes(label) ? graphs.splice(graphs.indexOf(label), 1) : graphs.push(label);

        setVisibleGraphs(graphs);
    }

    const colors = ['#38A169', '#319795', '#3182CE', '#805AD5', '#DD6B20'];

    const maxValue = Math.max(
        ...map(data, ([dataSet, dataSetLabel]) => {
            if (!visibleGraphs.includes(dataSetLabel) || !dataSet) {
                return 0;
            }

            return Math.max(...dataSet.map(([value]) => value));
        })
    );

    return (
        <>
            <div className="grid cols-auto gap-2 justify-start text-xs">
                {map(data, ([, dataSetLabel], index) => (
                    <button
                        className={'text-white px-2 py-1 rounded-full bg-gray-400 leading-none'}
                        key={index}
                        style={{ backgroundColor: visibleGraphs.includes(dataSetLabel) ? colors[index] : '' }}
                        onClick={() => toggleVisibility(dataSetLabel)}
                    >
                        {dataSetLabel}
                    </button>
                ))}
            </div>
            <div className="linechart mt-8">
                {map(data, ([dataSet, dataSetLabel], index) => {
                    if (!visibleGraphs.includes(dataSetLabel)) {
                        return;
                    }

                    const points = dataSet
                        ? dataSet
                              .map(([value], index) => {
                                  return `L ${index} ${maxValue - value}`;
                              })
                              .join(' ')
                        : '';

                    return (
                        <div key={index}>
                            {dataSet &&
                                dataSet.map(([value, label], setIndex) => (
                                    <div
                                        key={setIndex}
                                        className="linechart-x-line"
                                        style={{ left: `${(setIndex / (dataSet.length - 1)) * 100}%` }}
                                    >
                                        <div className="linechart-x-label">{label}</div>
                                        {value > 0 && (
                                            <div
                                                className="linechart-x-value"
                                                style={{
                                                    bottom: `${(value / maxValue) * 100}%`,
                                                    backgroundColor: colors[index],
                                                }}
                                            >
                                                {value}
                                            </div>
                                        )}
                                    </div>
                                ))}
                            <div className="linechart-y-line" style={{ bottom: '100%' }}>
                                <div className="linechart-y-label">{maxValue}</div>
                            </div>
                            <div className="linechart-y-line" style={{ bottom: '50%' }} />
                            <div className="linechart-y-line" style={{ bottom: '0' }} />
                            <svg
                                className="linechart-chart"
                                viewBox={`0 0 ${dataSet ? dataSet.length - 1 : 0} ${maxValue}`}
                                preserveAspectRatio="none"
                            >
                                <defs>
                                    <linearGradient id={`background-${index}`} x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style={{ stopColor: colors[index], stopOpacity: 0.4 }} />
                                        <stop offset="100%" style={{ stopColor: colors[index], stopOpacity: 0 }} />
                                    </linearGradient>
                                </defs>
                                <path
                                    d={`M 0 ${maxValue + 1} ${points} L 23 ${maxValue + 1} Z`}
                                    fill={`url(#background-${index})`}
                                />
                                <path
                                    d={points.replace('L', 'M')}
                                    fill="none"
                                    stroke={colors[index]}
                                    strokeOpacity="0.3"
                                    strokeWidth="1"
                                    strokeLinecap="round"
                                    vectorEffect="non-scaling-stroke"
                                />
                            </svg>
                        </div>
                    );
                })}
            </div>
        </>
    );
}
